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
        //
        $daftars = Daftar::all();
        $waktu = DB::table('wawancaras')
        ->select('waktu')
        ->get();
        return view('Wawancara.index')->with('daftars',$daftars)->with('waktu',$waktu);
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
