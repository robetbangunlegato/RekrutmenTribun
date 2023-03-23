<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Lamaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Lamaran.create');
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
        // $this->authorize('create', Lamaran::class);

        // melakukan validasi input
        $ValidasiData = $request->validate([
            'posisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|file|image|max:10000'
        ]);

        // alur data file foto
        // 1.ambil ekstensi file
        $ekstensi = $request->foto->getClientOriginalExtension();

        // 2.rename file berdasarkan waktu perdetik untuk menghindari kesamaan nama foto
        $nama_baru = "foto-".time().".".$ekstensi;

        // 3.simpan foto ke lokal public
        $alamat = $request->foto->storeAs('public',$nama_baru);

        // 4.buat sebuah objek dari tabel yang dimana kita akan menyimpan data-datanya.
        $lamarans = new Lamaran();
        $lamarans->posisi = $ValidasiData['posisi'];
        $lamarans->deskripsi = $ValidasiData['deskripsi'];
        $lamarans->foto = $nama_baru;

        // 5.simpan ke tabel tadi yang ada di database
        $lamarans->save();

        // 6.cek apakah data masuk atau tidak ke tabel
        if($lamarans->exists()){
            return redirect()->route('lamaran.index');
            $request->session()->flash('info','Lamaran Berhasil di Tambahkan!');

        }else{
            return redirect()->route('lamaran.create');
            $request->session()->flash('info','Lamaran Gagal di Tambahkan!');
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
