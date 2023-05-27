<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori_soals;
use App\Models\pilihans;
use Illuminate\Support\Facades\Redirect;


class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $soals = kategori_soals::all();
        return view('Pilihan.create')->with('soals',$soals);
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
            'pilihan' => 'required',
            'poin' => 'required|numeric|min:0',
            'soal_id' => 'required'
        ],[
            'pilihan.required' => 'Pilihan soal harus di isi!',
            'poin.required' => 'Poin harus di isi!',
            'poin.numeric'=>'Poin harus berupa angka!',
            'poin.min'=>'Poin minimal 0'
        ]);

        $pilihan = new pilihans();
        $pilihan->soals_id = $ValidasiData['soal_id'];
        $pilihan->pilihan = $ValidasiData['pilihan'];
        $pilihan->poin = $ValidasiData['poin'];

        $pilihan->save();
        $request->session()->flash('info','Pilihan berhasil di tambahkan!');
        return Redirect::back();
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
    public function edit(Request $request, $id)
    {
        //
        $pilihans = pilihans::find($id);
        return view('Pilihan.edit')->with('pilihans', $pilihans);
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
            'pilihan' => 'required',
            'poin' => 'required|numeric|min:0'
        ],[
            'pilihan.required' => 'Pilihan soal harus di isi!',
            'poin.required' => 'Poin harus di isi!',
            'poin.numeric'=>'Poin harus berupa angka!',
            'poin.min'=>'Poin minimal 0'
        ]);



        $pilihan = pilihans::find($id);
        $pilihan->pilihan = $ValidasiData['pilihan'];
        $pilihan->poin = $ValidasiData['poin'];

        $pilihan->update();
        $request->session()->flash('info','Pilihan berhasil di ubah!');
        return Redirect::back();
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
        $pilihans = pilihans::find($id);
        $pilihans->delete();
        $request->session()->flash('info','Data berhasil di hapus!');
        return Redirect::back();
    }
}
