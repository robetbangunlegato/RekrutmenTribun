<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('Setting.index')->with('users',$users);
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
        $users = User::find($id);
        return view('Setting.edit')->with('users',$users);
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
            'peran'=>'',
            'kata_sandi'=>''

        ]);
        
        // cari data dengan id yang ingin di edit
        $users =  User::find($id);

        // jika kata_sandi di input
        if($ValidasiData['kata_sandi'] != null){
            $password = bcrypt($ValidasiData['kata_sandi']);
        }

        // jika ada data
        if($ValidasiData['peran'] && $ValidasiData['kata_sandi']){
            $users->role = $ValidasiData['peran'];
            $users->password = $password;
            $users->update();
            $request->session()->flash('info', 'Data berhasil di ubah!');
            return redirect()->route('setting.index');
            
        // jika tidak ada data
        }elseif($ValidasiData['peran']){
            $users->role = $ValidasiData['peran'];
            $users->update();
            $request->session()->flash('info', 'Data berhasil di ubah!');
            return redirect()->route('setting.index');
        }elseif($ValidasiData['kata_sandi']){
            $users->password = $password;
            $users->update();
            $request->session()->flash('info', 'Data berhasil di ubah!');
            return redirect()->route('setting.index');
        }
        else{
            $request->session()->flash('info', 'Tidak ada data yang di ubah!');
            return redirect()->route('setting.index');
        }

        dd('kesalahan');
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
        $users = User::find($id);
        $users->delete();
        $request->session()->flash('info', 'Data berhasil di hapus!');
        return Redirect::back();

    }
}
