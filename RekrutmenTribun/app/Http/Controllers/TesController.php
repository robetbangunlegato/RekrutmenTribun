<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori_soals;
use App\Models\pilihans;
use App\Models\psikotes;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;
use App\Models\hasil_totals;
use Illuminate\Support\Facades\Session;
class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //        
        
        $kategori_soals = kategori_soals::all();
        $waktu_bukaArr = DB::table('psikotes')
                ->select('buka')
                ->get();

        $waktu_tutupArr = DB::table('psikotes')
                ->select('tutup')
                ->get();

        $waktu_buka = Carbon::parse($waktu_bukaArr[0]->buka);
        $waktu_tutup = Carbon::parse($waktu_tutupArr[0]->tutup);

        // ambil waktu saat ini
        $waktu_sekarang = Carbon::now('Asia/Jakarta');
        $waktu_sekarang_parse = Carbon::parse($waktu_sekarang);

        // cari status administrasi dan wawancara user login
        $status_administrasi = DB::table('daftars')
        ->select('status_administrasi')
        ->where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->first();
    
        
        $status_administrasi_id = '';
        if ($status_administrasi != null) {
            $status_administrasi_id = DB::table('daftars')
            ->select('id')
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first()->id;
        }
        
        
        
        if ($status_administrasi != null) {
            $status_administrasi = $status_administrasi->status_administrasi;
        }

        
        

        $status_wawancara = DB::table('wawancaras')
        ->select('status_wawancara')
        ->where('daftar_id',$status_administrasi_id)
        ->orderBy('created_at', 'desc')
        ->first();   
        
        if ($status_wawancara != null){
            $status_wawancara = $status_wawancara->status_wawancara;
        }
        
        if(strtotime($waktu_sekarang) >= strtotime($waktu_buka) && strtotime($waktu_sekarang) <= strtotime($waktu_tutup)){
            // cek apakah sudah 1x mengisi kuis di 1 sesi
            $user_id = auth()->user()->id;
            $tes = hasil_totals::where('user_id',$user_id)->first();
            dd('halaman tes2');
            // jika sudah ada data
            if($tes){
                dd('data sudah ada');
                $waktu_psikotes = psikotes::where('id',1)->first();

                // ambil waktu buka
                $waktu_bukaArr = psikotes::where('id',1)->first('buka');
                $waktu_buka = Carbon::parse($waktu_bukaArr['buka']);

                // waktu tutup
                $waktu_tutupArr = psikotes::where('id',1)->first('tutup');
                $waktu_tutup = Carbon::parse($waktu_tutupArr['tutup']);

                // ambil waktu input terbaru user
                $waktu_input_terbaru_nonparse = hasil_totals::where('user_id',$user_id)->latest()->value('created_at');
                $waktu_input_terbaru = Carbon::parse($waktu_input_terbaru_nonparse);

                if(strtotime($waktu_input_terbaru) >= strtotime($waktu_buka) && strtotime($waktu_input_terbaru) <= strtotime($waktu_tutup)){
                    
                    $request->session()->flash('info', 'Kamu hanya dapat mengerjakan kuis 1 kali dalam satu sesi!');
                    return view('Psikotes.index');

                }else{
                    return view('Tes.index')->with('kategori_soals', $kategori_soals)->with('waktu_tutup',$waktu_tutup)->with('status_administrasi',$status_administrasi)->with('status_wawancara',$status_wawancara);
                    
                }
            }else{
                return view('Tes.tutup');
                
            }
        }else{
            return view('Tes.tutup');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pilihan_pengguna = pilihans::find(array_values($request->input('soal')));

        // dd($pilihan_pengguna);
        
        $hasil = auth()->user()->hasil_User()->create([
            'total_poin' => $pilihan_pengguna->sum('poin')
        ]);

        $soals = $pilihan_pengguna->mapWithKeys(function ($pilihans){
            return [$pilihans->soals_id=>[
                'pilihans_id' => $pilihans->id,
                'poin' => $pilihans->poin

            ]
        ];
        })->toArray();

        $hasil->soals()->sync($soals);
        $request->session()->flash('info','Kuis berhasil di kumpulkan, silahkan tunggu pengumuman akhir!');
        return redirect()->route('psikotes.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $ValidasiData = $request->validate([
            'tanggal_buka' => 'required',
            'waktu_buka'=>'required',
            'tanggal_tutup'=>'required',
            'waktu_tutup'=>'required'
        ]);


        // ambil waktu buka
        $tanggal_buka = $ValidasiData['tanggal_buka'];
        $waktu_buka = $ValidasiData['waktu_buka'];
        $buka_lamaran = Carbon::parse("$tanggal_buka $waktu_buka")->format('Y-m-d H:i:s');
        
        // ambil waktu tutup
        $tanggal_tutup = $ValidasiData['tanggal_tutup'];
        $waktu_tutup = $ValidasiData['waktu_tutup'];
        $tutup_lamaran = Carbon::parse("$tanggal_tutup $waktu_tutup")->format('Y-m-d H:i:s');

        // ambil waktu saat ini
        $waktu_sekarang = Carbon::now('Asia/Jakarta');
        $waktu_sekarang_parse = Carbon::parse($waktu_sekarang);

        if(strtotime($buka_lamaran) >= strtotime($tutup_lamaran)){
            $request->session()->flash('info','Waktu buka harus lebih dulu dari waktu tutup!');
            return redirect()->route('tes.index');
        }else{
            $psikotes = psikotes::find($id);
            $psikotes->buka = $buka_lamaran;
            $psikotes->tutup = $tutup_lamaran;
            $psikotes->update();
            $request->session()->flash('info','Waktu telah di ubah!');
            return redirect()->route('tes.index');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
