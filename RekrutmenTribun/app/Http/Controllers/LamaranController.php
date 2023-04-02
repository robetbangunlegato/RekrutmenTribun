<?php
namespace App\Http\Controllers;
use Carbon\carbon;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $lamarans = Lamaran::all();
        return view('Lamaran.index')->with("lamarans", $lamarans);
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
        // melakukan validasi input
        $ValidasiData = $request->validate([
            'posisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|file|image|max:800|mimes:JPG,jpeg'
        ],[
            'foto.mimes' => 'Format gambar harus JPG/jpeg!',
            'foto.max' => 'Ukuran maksimal 800KB!',
            'required' => 'Foto thumbnail harus di isi!'
        ]);

        // -----alur data file foto-----
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
            // Session::flash('success', 'Data berhasil disimpan!');
            $request->session()->flash('info','Data berhasil di simpan!');
            return redirect()->route('lamaran.index');

        }else{
            $request->session()->flash('info','Lamaran Gagal di Tambahkan!');
            return redirect()->route('lamaran.create');
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
        if (!$id) {
        return redirect()->back();
    }else{
        // meengambil data yang dipilih (semua kolom)
        $data = Lamaran::findOrFail($id);
        // mengambil data id yang dipilih (kolom id saja)
        $id = $data->id;
        // mengirim data dengan key acess 'id'
        Session::put('id', $id);
        // memindahkan view ke halaman daftar index
        return redirect()->route('daftar.index');
    }

        
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
        $lamaran = Lamaran::find($id);
        return view('Lamaran.edit')->with('lamarans',$lamaran);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Lamaran $lamaran)
    {
        // melakukan validasi input
        $ValidasiData = $request->validate([
            'posisi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'file|image|max:800|mimes:JPG,jpeg'
        ],[
            'foto.mimes' => 'Format gambar harus JPG/jpeg!',
            'foto.max' => 'Ukuran maksimal 800KB!'
        ]);

        $nama_baru = '';

        if($request->hasFile('foto')){
            $nama_foto_lama = $lamaran->foto;
            Storage::delete(['public/'.$nama_foto_lama]);
            $ekstensi = $request->foto->getClientOriginalExtension();
            $nama_baru = "foto-".time().".".$ekstensi;
            $alamat = $request->foto->storeAs('public',$nama_baru);
        }else{
            $ValidasiData['foto']=$lamaran->foto;
            $nama_baru = $ValidasiData['foto'];
        }

        // buat sebuah objek dari tabel yang dimana kita akan menyimpan data-datanya.
        $lamaran = Lamaran::find($lamaran->id);           
        $lamaran->posisi = $ValidasiData['posisi'];
        $lamaran->deskripsi = $ValidasiData['deskripsi'];
        $lamaran->foto = $nama_baru;

        // simpan ke tabel tadi yang ada di database
        $lamaran->update();          

        // 6.cek apakah data ter update atau tidak ke tabel
        if($lamaran->exists()){
            $request->session()->flash('info','Data berhasil di ubah!');
            return redirect()->route('lamaran.index');

        }else{
            $request->session()->flash('info','Lamaran gagal di ubah!');
            return redirect()->route('lamaran.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lamaran $lamaran)
    {   

        // menghapus foto dari local storage
        // 1.ambil nama file yang ingin di hapus
        $nama_foto = Lamaran::find($lamaran)->pluck('foto');
        // 2.hapus file tersebut tapi pastikan bentuk nama nya berbentuk single value buka array, selesai foto di local sudah terhapus.
        Storage::delete(['public/'.$nama_foto[0]]);

        $lamaran->delete();
        return redirect()->route('lamaran.index')->with('info',"Lowongan $lamaran->posisi berhasil di hapus");

    }
}
