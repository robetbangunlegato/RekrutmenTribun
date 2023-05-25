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
            'poin' => 'required|numeric',
            'soal_id' => 'required'
        ],[
            'pilihan.required' => 'Pilihan soal harus di isi!',
            'poin.required' => 'Poin harus di isi!',
            'poin.numeric'=>'Poin harus berupa angka!'
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
