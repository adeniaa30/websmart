<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\alternatif;
use App\Models\lab;
use App\Models\usermhs;

class LoginMhsController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('name', 'Nurul Hapsari Adenia')->first();
 
        return $users->email;
    }

    public function dashmhs(Request $request){
        $nim = $request->input('nim');
        $data = usermhs::where('nim', $nim)->value('nim');
        $distinct_nama_lab = lab::distinct('nama_lab')->pluck('nama_lab');
        $lab_pc = lab::where('nama_lab', 'Laboratorium Pertanian Cerdas')->value('nama_lab');
        return view('mahasiswa.dashMahasiswa',[
            'data'=>$data,
            'distinct_nama_lab' => $distinct_nama_lab,
            'lab_pc' => $lab_pc, 
            'nim' => $nim
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
