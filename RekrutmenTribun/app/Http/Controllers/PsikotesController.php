<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psikotes;

class PsikotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //mengambil ip
        $psikotes = Psikotes::all();
        return view('Psikotes.index')->with('psikotes',$psikotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Psikotes.create');
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
            'kategori_soal' => 'required',
            'waktu_pengerjaan' => 'required'
        ]);

        $psikotes = new Psikotes();
        $psikotes->kategori_soal = $ValidasiData['kategori_soal'];
        $psikotes->waktu_pengerjaan = $ValidasiData['waktu_pengerjaan'];
        $psikotes->save();

        $request->session()->flash('info','Data berhasil di tambah');
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
        $psikotes = Psikotes::find($id);
        return view('Psikotes.edit')->with('psikotes',$psikotes);

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
            'kategori_soal'=>'required',
            'waktu_pengerjaan'=>'required'
        ]);

        $psikotes = Psikotes::find($id);
        $psikotes->kategori_soal = $ValidasiData['kategori_soal'];
        $psikotes->waktu_pengerjaan = $ValidasiData['waktu_pengerjaan'];
        $psikotes->update();
        $request->session()->flash('info','Data berhasil di ubah!');
        return redirect()->route('psikotes.index');
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
        $psikotes = Psikotes::find($id);
        $psikotes->delete();
        return redirect()->route('psikotes.index')->with('info','Data kategori soal berhasil di hapus!');
    }
}
