<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar;
use App\Models\Wawancara;
use App\Models\hasil_akhir;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;

class WawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil user role
        $user_id = auth()->user()->id;
        $user_role = auth()->user()->role;

        if($user_role == 'admin'){
            $daftars = Daftar::all();
            $waktu = DB::table('wawancaras')
            ->select('waktu')
            ->get();
            $wawancaras = Wawancara::all();
            return view('Wawancara.index')->with('daftars',$daftars)->with('waktu',$waktu);
        }else{
            $daftar_id = DB::table('daftars')
            ->select('id')
            ->where('user_id',$user_id)
            ->first();

            // jika daftar id tidak ditemukan
            if($daftar_id == null){
                $daftar_id = '';
            // jika data daftar_id ditemukan
            }elseif($daftar_id != null){;
                $daftar_id = $daftar_id->id;
            }
            
            $wawancaras = DB::table('wawancaras')
            ->select('wawancaras.*')
            ->where('daftar_id',$daftar_id)
            ->get();

            // dd($wawancaras);
            return view('Wawancara.index')->with('wawancaras',$wawancaras);
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
        $ValidasiData = $request->validate([
            'id_kirim' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'
        ]);

        // ambil tanggal dan waktu
        $tanggal = $ValidasiData['tanggal'];
        $waktu = $ValidasiData['waktu'];
        $tanggal_waktu = Carbon::parse("$tanggal $waktu")->format('Y-m-d H:i:s');

        $wawancaras = new Wawancara();
        $wawancaras->waktu = $tanggal_waktu;
        $wawancaras->daftar_id = $ValidasiData['id_kirim'];
        $wawancaras->save();

        $daftars = Daftar::all();
        return view('Wawancara.index')->with('daftars',$daftars);        
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
        $nama = DB::table('users')
        ->select('users.name')
        ->join('daftars','users.id','=','daftars.user_id')
        ->join('wawancaras','daftars.id','=','wawancaras.daftar_id')
        ->where('wawancaras.id',$id)
        ->get();

        $wawancara_daftarID = DB::table('wawancaras')
        ->select('daftar_id')
        ->where('id',$id)
        ->get();

        $wawancara_daftarID_singleValue = $wawancara_daftarID[0]->daftar_id;

        $daftars = DB::table('daftars')
        ->select('daftars.*')
        ->join('wawancaras','daftars.id','=','wawancaras.daftar_id')
        ->where('wawancaras.daftar_id',$wawancara_daftarID_singleValue)
        ->get();

        $wawancaras = Wawancara::find($id);
        return view('Wawancara.show')->with('wawancaras',$wawancaras)->with('daftars',$daftars)->with('nama',$nama);
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
        $catatan = $request->input('catatan');
        $wawancara = Wawancara::find($id);
        $wawancara->catatan = $catatan;
        $wawancara->update();
        return back()->with('info','Catatan Berhasil di Simpan!');
        
    }

    public function acc(Request $request, $id)
    {
        // 
        

        $user_id = $request->input('user_id');
        $hasil_akhir = new hasil_akhir();
        $hasil_akhir->users_id = $user_id;
        $hasil_akhir->save();

        $respon = $request->input('status_wawancara');
        $wawancara = Wawancara::find($id);
        $wawancara->status_wawancara = $respon;
        $wawancara->update();

        

        return back()->with('info','Status berhasil di ubah!');

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
