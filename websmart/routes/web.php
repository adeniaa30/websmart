<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('register');
});

// Route::get(RegisterController::class)->group(function(){
//     Route::get('/register', 'register')->name('register');
//     Route::post('/store', 'store')->name('store');
//     Route::post('/authenticate', 'authenticate')->name('authenticate');
//     Route::get('/dashboard', 'dashboard')->name('dashboard');
//     Route::post('/logout', 'logout')->name('logout');
// });


Route::post('/store', [RegisterController::class, 'store'])->name('store');
Route::get('/register',[ RegisterController::class, 'register'])->name('register');
Route::post('/authenticate',[LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');


// ADMIN
Route::get('/dashboardadmin', function () {
    return view('admin.dashboard');
})->name('dashboardadmin');

Route::get('/kriteria', function () {
    return view('admin.kriteria');
});

Route::get('/subkriteria', function () {
    return view('admin.subkriteria');
});

Route::get('/alternatif', function () {
    return view('admin.alternatif');
});

Route::get('/nilai', function () {
    return view('admin.nilai');
});

Route::get('/spk', function () {
    return view('admin.spk');
});

// MAHASISWA
Route::get('/dashboardmhs', function () {
    return view('mahasiswa.dashMahasiswa');
});

Route::get('/formlab', function () {
    return view('mahasiswa.formlab');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
