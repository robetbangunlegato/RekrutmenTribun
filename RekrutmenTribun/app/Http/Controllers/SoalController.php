<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori_soals;
use App\Models\soals;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Soal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori_soal = kategori_soals::all();
        $soals = soals::all();
        return view('Soal.create')->with('kategori_soal', $kategori_soal)->with('soals',$soals);
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
            'soal' => 'required',
            'kategori_soal_id' => 'required'
        ],[
            'soal.required' => 'Soal harus di isi!',
            'kategori_soal_id.required' => 'Kategori soal harus di pilih!',

        ]);

        $soals = new soals();
        $soals->soal = $ValidasiData['soal'];
        $soals->kategori_soals_id = $ValidasiData['kategori_soal_id'];

        // simpan data soal
        $soals->save();
        return redirect()->route('soal.create');        
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
        $soal = soals::find($id);

        $kategori_id = DB::table('soals')
        ->select('kategori_soals_id')
        ->where('id',$id)
        ->get();

        $kategori_soals = DB::table('kategori_soals')
        ->select('kategori_soal')
        ->where('id',$kategori_id[0]->kategori_soals_id)
        ->get();

        $kategori_soal = $kategori_soals[0]->kategori_soal;
        
        $pilihan = DB::table('pilihans')
        ->select('pilihans.*')
        ->where('soals_id',$soal->id)
        ->get();
        
        return view('Soal.show')->with('soal',$soal)->with('kategori_soal',$kategori_soal)->with('pilihans',$pilihan);
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
        $soals = soals::find($id);        
        return view('Soal.edit')->with('soals',$soals);
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
            'soal' => 'required'
        ],[
            'soal.required' => 'Soal harus di isi!'
        ]);

        $soals = soals::find($id);
        $soals->soal = $ValidasiData['soal'];
        $soals->update();

        $request->session()->flash('info','Data berhasil di ubah!');
        return redirect()->route('soal.create');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $soals = soals::find($id);
        $soals->delete();
        $request->session()->flash('info','Data berhasil di hapus!');
        return Redirect::back();
    }
}
