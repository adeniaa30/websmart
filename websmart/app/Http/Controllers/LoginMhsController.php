<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\alternatif;
use App\Models\lab;
use App\Models\nilai_akhir;
use App\Models\usermhs;

class LoginMhsController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('name', 'Nurul Hapsari Adenia')->first();
 
        return $users->email;
    }

    public function dashmhs(Request $request){

        $distinct_nama_lab = lab::distinct('nama_lab')->pluck('nama_lab');
        $tahun = nilai_akhir::selectRaw('YEAR(date) as year')->distinct()->pluck('year');
        return view('mahasiswa.dashMahasiswa',[
            'distinct_nama_lab' => $distinct_nama_lab,
            'tahun' => $tahun,
        ]);
    }

    public function loginmhs(){
        return view('auth.loginmhs');
    }

    public function authmhs(Request $request)
    {   
        $nim = $request->input('nim');
        // $pw = $request->input('password');
        $query = DB::table('usermhs')->where('nim', $nim)->value('nim');
        // return $query;
        if($query == $nim){
            $request->session()->regenerate();
            return redirect()->route('dashmhs', ['nim'=>$nim])
                ->withSuccess('You have successfully logged in!');
        }

        // $credentials = $request->validate([
        //     'nim' => 'required',
        //     'password' => 'required'
        // ]);

        // if(Auth::guard('usermhs')->attempt($credentials))
        // {
        //     $request->session()->regenerate();
        //     return redirect()->route('dashmhs')
        //         ->withSuccess('You have successfully logged in!');
        // }

        // return back()->withErrors([
        //     'nim' => 'Your provided credentials do not match in our records.',
        //     'password' => 'Your provided credentials do not match in our records.',
        // ]);

    } 

    public function logoutmhs(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginmhs')
            ->withSuccess('You have logged out successfully!');;
    }  
}
