<?php

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

// ADMIN
Route::get('/', function () {
    return view('admin.dashboard');
});

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
Route::get('/dashboard', function () {
    return view('mahasiswa.dashMahasiswa');
});

Route::get('/formlab', function () {
    return view('mahasiswa.formlab');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
