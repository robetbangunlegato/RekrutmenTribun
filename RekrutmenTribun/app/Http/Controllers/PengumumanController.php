<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hasil_totals;
use App\Models\kategori_soals;
use App\Models\hasil_akhir;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $hasil_totals = hasil_totals::all();
            if($hasil_totals){
                $hasil_totals = $hasil_totals;
            }else{
                $hasil_totals=[];
            }
        }else{
            $hasil_totals = DB::table('hasil_totals')
            ->select('hasil_totals.created_at','hasil_totals.status_akhir')
            ->where('user_id',auth()->user()->id)
            ->get();

            if($hasil_totals){
                $hasil_totals = $hasil_totals;
            }else{
                $hasil_totals=[];
            }
        }
        return view('Pengumuman.index')->with('hasil_totals',$hasil_totals);
        
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
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hasil_totals_soals = DB::table('hasil_totals_soals')
        ->join('soals', 'hasil_totals_soals.soals_id', '=', 'soals.id')
        ->join('kategori_soals', 'soals.kategori_soals_id', '=', 'kategori_soals.id')
        ->join('hasil_totals', 'hasil_totals_soals.hasil_totals_id', '=', 'hasil_totals.id')
        ->join('users', 'hasil_totals.user_id', '=', 'users.id')
        ->where('users.id', '=', $id)
        ->groupBy('kategori_soals.kategori_soal', 'users.name', 'users.id','hasil_totals.status_akhir') // Mengelompokkan berdasarkan kategori_soal dan nama user
        ->select('kategori_soals.kategori_soal', 'users.name','users.id','hasil_totals.status_akhir', DB::raw('SUM(hasil_totals_soals.poin) as total_poin'))
        ->get();

        $rowspan = kategori_soals::count();
        return view('Pengumuman.show')->with('hasil_totals_soals',$hasil_totals_soals)->with('rowspan',$rowspan);
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
        $status_akhir_input = $request->input('hasil_akhir');
        $hasil_akhir = hasil_totals::find($id);
        $hasil_akhir->status_akhir = $status_akhir_input;
        $hasil_akhir->update();
        $request->session()->flash('info','Status berhasil di ubah');
        return redirect()->route('pengumuman.index');
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

    public function rekap(){
        $hasil_totals = hasil_totals::where('status_akhir','diterima')->get();
        return view('Pengumuman.rekap')->with('hasil_totals',$hasil_totals);
    }
}
