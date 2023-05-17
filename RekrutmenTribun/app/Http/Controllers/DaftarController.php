<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\DaftarController;
use App\Models\Lamaran;
use App\Models\Daftar;
use Carbon\carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $lamaranController;

    public function __construct(LamaranController $lamaranController)
    {
        return $this->lamaranController = $lamaranController;
    }
    
    public function index(Request $request)
    {
        //
        $id_lamaran = Session::get('id');
        if($id_lamaran == null){
            return $this->lamaranController->index();

        }else{
            // cek apakah sudah pernah isi data
            // ambil user id
            $userId = auth()->user()->id;
            $daftars = Daftar::where('user_id',$userId)->first();

            // jika sudah ada data
            if($daftars){

                $lamaran_dipilih = Lamaran::where('id', $id_lamaran)->first();
                // ambil waktu buka
                $waktu_bukaArr = Lamaran::where('id', $id_lamaran)->first('buka');
                $waktu_buka = Carbon::parse($waktu_bukaArr['buka']);

                // ambil waktu tutup
                $waktu_tutupArr = Lamaran::where('id',$id_lamaran)->first('tutup');
                $waktu_tutup = Carbon::parse($waktu_tutupArr['tutup']);

                // waktu input terbaru user
                $waktu_input_terbaru_nonparse = Daftar::where('user_id',$userId)->latest()->value('waktu_kirim');
                $waktu_input_terbaru = Carbon::parse($waktu_input_terbaru_nonparse);

                if(strtotime($waktu_input_terbaru) >= strtotime($waktu_buka) && strtotime($waktu_input_terbaru) <= strtotime($waktu_tutup)){
                    $lamaran = Lamaran::all();
                    $request->session()->flash('info', 'Kamu hanya dapat mengirimkan 1 formulir lamaran dalam 1 kali sesi rekrutmen!');
                    return view('Lamaran.index')->with('lamarans',$lamaran);
                }else{
                    $lamaran_dipilih = Lamaran::where('id', $id_lamaran)->first();
                    // ambil waktu buka
                    $waktu_bukaArr = Lamaran::where('id', $id_lamaran)->first('buka');
                    $waktu_buka = Carbon::parse($waktu_bukaArr['buka']);

                    // ambil waktu tutup
                    $waktu_tutupArr = Lamaran::where('id',$id_lamaran)->first('tutup');
                    $waktu_tutup = Carbon::parse($waktu_tutupArr['tutup']);

                    // ambil waktu saat ini
                    $waktu_sekarang = Carbon::now('Asia/Jakarta');
                    $waktu_sekarang_parse = Carbon::parse($waktu_sekarang);

                    // bandingkan waktu nya
                    // jika waktu sekarang sama atau melewati waktu buka dan tidak melebihi waktu tutup maka tampilkan form
                    if(strtotime($waktu_sekarang) >= strtotime($waktu_buka) && strtotime($waktu_sekarang) <= strtotime($waktu_tutup)){
                        return view('Daftar.index')->with('daftar',$lamaran_dipilih)->with('waktu_tutup',$waktu_tutup);
                    // kondisi selain di atas, maka form di tutup
                    }else{
                        return view('Daftar.tutup')->with('id',$id_lamaran);
                    }

                }

                            
            }else{
                $lamaran_dipilih = Lamaran::where('id', $id_lamaran)->first();
                // ambil waktu buka
                $waktu_bukaArr = Lamaran::where('id', $id_lamaran)->first('buka');
                $waktu_buka = Carbon::parse($waktu_bukaArr['buka']);

                // ambil waktu tutup
                $waktu_tutupArr = Lamaran::where('id',$id_lamaran)->first('tutup');
                $waktu_tutup = Carbon::parse($waktu_tutupArr['tutup']);

                // ambil waktu saat ini
                $waktu_sekarang = Carbon::now('Asia/Jakarta');
                $waktu_sekarang_parse = Carbon::parse($waktu_sekarang);

                // bandingkan waktu nya
                // jika waktu sekarang sama atau melewati waktu buka dan tidak melebihi waktu tutup maka tampilkan form
                if(strtotime($waktu_sekarang) >= strtotime($waktu_buka) && strtotime($waktu_sekarang) <= strtotime($waktu_tutup)){
                    return view('Daftar.index')->with('daftar',$lamaran_dipilih)->with('waktu_tutup',$waktu_tutup);
                // kondisi selain di atas, maka form di tutup
                }else{
                    return view('Daftar.tutup')->with('id',$id_lamaran);
                }
            }    
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
        // waktu upload
        $waktu_upload = Carbon::now('Asia/Jakarta');

        $ValidasiData = $request->validate([
            'ktp' => 'required|file|image|max:800|mimes:JPG,jpeg',
            'npwp' => 'required|file|image|max:800|mimes:JPG,jpeg',
            'cv' => 'required|file|image|max:800|mimes:JPG,jpeg',
            'lamaran' => 'required|file|image|max:800|mimes:JPG,jpeg',
            'data_pendukung' => 'file|mimes:PDF,pdf|max:2000',
            'id'=>'required'

        ],[
            'ktp.required' => 'File KTP harus di masukan!',
            'ktp.file' => 'File KTP harus berupa file foto (JPG)!',
            'ktp.max' => 'Ukuran maksimal 800KB!',
            'ktp.mimes' => 'Foto harus berformat JPG',
            'ktp.image' => 'File yang dimaskan harus berupa gambar!',
            'npwp.required' => 'File NPWP harus di masukan!',
            'npwp.file' => 'File NPWP harus berupa file foto (JPG)!',
            'npwp.max' => 'Ukuran maksimal 800KB!',
            'npwp.image' => 'File yang dimaskan harus berupa gambar!',
            'npwp.mimes' => 'NPWP harus berformat JPG',
            'cv.required' => 'File CV harus di masukan!',
            'cv.file' => 'File CV harus berupa file foto (JPG)!',
            'cv.image' => 'File yang dimaskan harus berupa gambar!',
            'cv.max' => 'Ukuran maksimal 800KB!',
            'cv.mimes' => 'CV harus berformat JPG',
            'lamaran.required' => 'File lamaran harus di masukan!',
            'lamaran.file' => 'File lamaran harus berupa file foto (JPG)!',
            'lamaran.image' => 'File yang dimaskan harus berupa gambar!',
            'lamaran.max' => 'Ukuran maksimal 800KB!',
            'lamaran.mimes' => 'Lamaran harus berformat JPG',
            'data_pendukung.file' => 'File data pendukung harus berupa file PDF!',
            'data_pendukung.max' => 'Ukuran maksimal 2MB!',
            'data_pendukung.mimes' => 'Data pendukung harus berformat PDF'
        ]);

        // ktp
        $ktp = "ktp-".time().".jpg";
        $nama_ktp = $request->ktp->storeAs('public/daftar',$ktp);

        // npwp
        $npwp = "npwp-".time().".jpg";
        $nama_npwp = $request->npwp->storeAs('public/daftar',$npwp);

        // cv
        $cv = "cv-".time().".jpg";
        $nama_cv = $request->cv->storeAs('public/daftar',$cv);

        // lamaran
        $lamaran = "surat_lamaran-".time().".jpg";
        $nama_lamaran = $request->lamaran->storeAs('public/daftar',$lamaran);

        
        // data_pendukung
        $data_pendukung = '-';
        if($request->hasFile('data_pendukung')){
            $data_pendukung = "data_pendukung-".time().".pdf";
            $nama_data_pendukung = $request->data_pendukung->storeAs('public/daftar',$data_pendukung);
        }

        $daftars = new Daftar();
        $daftars->user_id = Auth::user()->id;
        $daftars->lamaran_id = $ValidasiData['id'];
        $daftars->ktp = $ktp;
        $daftars->npwp = $npwp;
        $daftars->cv = $cv;
        $daftars->surat_lamaran = $lamaran;
        $daftars->data_pendukung = $data_pendukung;
        $daftars->waktu_kirim = $waktu_upload;

        $daftars->save();

        if($daftars->exists()){
            $request->session()->flash('info', 'Data berkas rekrutmen berhasil di kirim, tunggu di respon oleh HRD!');
            return redirect()->route('lamaran.index');
        }else{
            $request->session()->flash('info','Data berkas rekrutmen gagal di kirim, silahkan di kirim ulang');
            // dd('gagal');
            return redirect()->route('daftar.index');
        }
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

    public function showadmin(){
        $daftars = Daftar::all();
        return view ('Daftar.rekapadmin')->with('daftars', $daftars);
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
        //validasi input
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
            return redirect()->route('daftar.index');
        }else{
            $waktu_lamaran = Lamaran::find($id);
            $waktu_lamaran->buka = $buka_lamaran;
            $waktu_lamaran->tutup = $tutup_lamaran;
            $waktu_lamaran->update();
            $request->session()->flash('info','Waktu telah di ubah!');
            return redirect()->route('daftar.index');
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
