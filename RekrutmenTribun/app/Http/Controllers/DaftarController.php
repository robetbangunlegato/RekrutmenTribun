<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LamaranController;
use App\Models\Lamaran;
use Carbon\carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $id_lamaran = Session::get('id');
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
            return view('Daftar.index')->with('daftar',$lamaran_dipilih);
        // kondisi selain di atas, maka form di tutup
        }else{
            return view('Daftar.tutup');
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
