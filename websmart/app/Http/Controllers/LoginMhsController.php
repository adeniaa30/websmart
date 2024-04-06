<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginMhsController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('name', 'Nurul Hapsari Adenia')->first();
 
        return $users->email;
    }

    public function dashmhs(){
        return view('mahasiswa.dashMahasiswa');
    }

    public function loginmhs(){
        return view('auth.loginmhs');
    }

    public function authmhs(Request $request)
    {   
        $nim = $request->input('nim');
        // $pw = $request->input('password');
        $query = DB::table('usermhs')->where('nim', '12345')->value('nim');
        // return $query;
        if($query == $nim){
            $request->session()->regenerate();
            return redirect()->route('dashmhs')
                ->withSuccess('You have successfully logged in!');
        }
        // $credentials = $request->validate([
        //     'nim' => [$query],
        // ]);

        // if(Auth::attempt($credentials))
        // {
        //     $request->session()->regenerate();
        //     return redirect()->route('loginmhs')
        //         ->withSuccess('You have successfully logged in!');
        // }

        return back()->withErrors([
            'nim' => 'Your provided credentials do not match in our records.',
            'password' => 'Your provided credentials do not match in our records.',
        ]);

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
