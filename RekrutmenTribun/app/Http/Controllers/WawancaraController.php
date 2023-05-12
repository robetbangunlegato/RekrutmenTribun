<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar;
use App\Models\Wawancara;
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
            return view('Wawancara.index')->with('daftars',$daftars)->with('waktu',$waktu);
        }else{
            $wawancaras = DB::table('wawancaras')
            ->select('wawancaras.*')
            ->where('id',$user_id)
            ->get();
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

        // dd($daftars, 'ini dd daftars di controller',$id);

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
