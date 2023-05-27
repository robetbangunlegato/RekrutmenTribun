<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\kategori_soals;

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
        $kategori_soals = kategori_soals::all();
        return view('Psikotes.index')->with('kategori_soals',$kategori_soals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori_soals = kategori_soals::withCount('soals')->groupBy('id')->get();
        return view('Psikotes.create')->with('kategori_soals',$kategori_soals);
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
            'kategori_soal' => 'required'
        ]);

        // cari apakah ada yang salah kategori soal nya
        $cek_baris = kategori_soals::where('kategori_soal',$ValidasiData['kategori_soal'])->first();

        if($cek_baris){
            // jika data sudah ada
            $request->session()->flash('info','Kategori tersebut sudah ada, silahkan input kategori yang lain!');
            return Redirect::back();
            
        }else{     
            // jika data belum ada, maka per bolehkan simpan data
            $psikotes = new kategori_soals();
            $psikotes->kategori_soal = $ValidasiData['kategori_soal'];
            $psikotes->save();

            $request->session()->flash('info','Data berhasil di tambah');
            return redirect()->route('psikotes.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kategori_soals = kategori_soals::find($id);
        return view('Psikotes.edit')->with('kategori_soals',$kategori_soals);

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
            'kategori_soal'=>'required'
        ]);

        $psikotes = kategori_soals::find($id);
        $psikotes->kategori_soal = $ValidasiData['kategori_soal'];
        $psikotes->update();
        $request->session()->flash('info','Data berhasil di ubah!');
        return redirect()->route('psikotes.create');
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
        $kategori_soals = kategori_soals::find($id);
        $kategori_soals->delete();
        $request->session()->flash('info','Data berhasil di hapus!');
        return redirect()->route('psikotes.create');
    }
}
