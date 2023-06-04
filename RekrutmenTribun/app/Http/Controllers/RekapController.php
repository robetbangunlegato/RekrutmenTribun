<?php

namespace App\Http\Controllers;
use App\Models\lamarans;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_role = Auth::user()->role;
        
        
        if($user_role == 'non-admin'){
            $user = Auth::user()->id;
            
            $daftars = DB::table('lamarans')
            ->select('lamarans.*','lowongans.posisi')
            ->join('users','users.id','=','lamarans.user_id')
            ->join('lowongans', 'lamarans.lamaran_id','=','lowongans.id')
            ->where('user_id',$user)
            ->get();


            if(count($daftars) < 1){
                $daftars = 'Tidak ada data';
                return view('Daftar.rekapadmin')->with('daftars',$daftars)->with('role',$user_role);
            }else{
                // dd($user_rule);
                return view('Daftar.rekapadmin')->with('daftars',$daftars)->with('role',$user_role); 
            }            
            
        }elseif($user_role == 'admin'){
            $daftars = lamarans::all();
            if(count($daftars) < 1){
                $daftars = 'Tidak ada data';
            }
            return view('Daftar.rekapadmin')->with('daftars',$daftars)->with('role',$user_role);
        }
        
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
        $update_status_administrasi = $request->input('status_administrasi');
        $daftar = lamarans::find($id);
        $daftar->status_administrasi = $update_status_administrasi;
        $daftar->update();
        
        return redirect()->action([RekapController::class,'index']);
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
