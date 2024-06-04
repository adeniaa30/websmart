<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginMhsController;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\smartController;
use App\Http\Controllers\smartpcController;
use App\Http\Controllers\smartITController;
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

// LOGIN ADMIN
Route::get('/admin', function () {
    return view('auth.login');
});
// REGISTER ADMIN
Route::get('/register', function () {
    return view('register');
});

// LOGIN MAHASISWA
Route::get('/', function () {
    return view('auth.loginmhs');
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

Route::get('/loginmhs',[ LoginMhsController::class, 'loginmhs'])->name('loginmhs');
Route::post('/authmhs',[ LoginMhsController::class, 'authmhs'])->name('authmhs');

Route::post('/logoutmhs',[LoginMhsController::class, 'logoutmhs'])->name('logoutmhs');
// Route::get('/',[LoginMhsController::class, 'loginmhs'])->name('loginmhs');
Route::get('/dashboardMahasiswa',[LoginMhsController::class, 'dashmhs'])->name('dashmhs');

// ADMIN
Route::resource('admin', adminController::class);

Route::get('/dashboardadmin', function () {
    return view('admin.dashboard');
})->name('dashboardadmin');

Route::get('/kriteria', [adminController::class, 'kriteria'])->name('kriteria');

Route::get('/subkriteria', [adminController::class, 'subkriteria'])->name('subkriteria');

Route::get('/alternatif', [adminController::class, 'alternatif'])->name('alternatif');

Route::post('/store_alternatif', [adminController::class, 'store'])->name('store_alternatif');

Route::get('admin/{da_nim}/{da_lab}/edit_da', [AdminController::class, 'edit_da'])->name('edit_da');

Route::put('/update_alternatif/{da_nim}/{da_lab}', [adminController::class, 'update'])->name('update_alternatif');

Route::post('/update_status/{da_nama}/{da_lab}', [adminController::class, 'update_status'])->name('update_status');

Route::post('/store_kriteria', [adminController::class, 'storeKriteria'])->name('store_kriteria');

Route::put('/update_kriteria/{id}', [adminController::class, 'update_kriteria'])->name('update_kriteria');

Route::get('admin/{id}/edit_kriteria', [AdminController::class, 'edit_kriteria']);

Route::get('edit_al/{id}', [AdminController::class, 'edit'])->name('edit_al');

Route::delete('admin/{id}/del_kriteria', [AdminController::class, 'del_kriteria']);

Route::post('/store_sub', [adminController::class, 'store_sub'])->name('store_sub');

Route::get('admin/{id}/edit_sub', [AdminController::class, 'edit_sub']);

Route::put('/update_sub/{id}', [adminController::class, 'update_sub'])->name('update_sub');

Route::delete('admin/{id}/del_sub', [AdminController::class, 'del_sub']);

Route::delete('admin/{da_nama}/{da_lab}/del_calon', [AdminController::class, 'del_calon']);

Route::get('/nilai', [adminController::class, 'nilai'])->name('nilai');

Route::post('/store_nilai', [adminController::class, 'store_nilai'])->name('store_nilai');

Route::get('/spk', function () {
    return view('admin.spk');
});

// MAHASISWA
Route::get('/dashboardmhs', function () {
    return view('mahasiswa.dashMahasiswa');
});

Route::GET('/search', [mahasiswaController::class, 'search'])->name('search');

Route::get('/show_search', [mahasiswaController::class, 'show_search'])->name('show_search');

Route::GET('/formlab', [mahasiswaController::class, 'formlab'])->name('formlab');

Route::GET('/showform', [mahasiswaController::class, 'showform'])->name('showform');

Route::GET('/view_form', [mahasiswaController::class, 'view_form'])->name('view_form');

Route::put('/submitform', [mahasiswaController::class, 'submitform'])->name('submitform');

Route::get('/pdf/sp/{id}', [adminController::class, 'showpdf_sertifprestasi'])->name('showpdf_sertifprestasi');

Route::get('/pdf/so/{id}', [adminController::class, 'showpdf_sertiforganisasi'])->name('showpdf_sertiforganisasi');

Route::get('/pdf/khs/{id}', [adminController::class, 'showpdf_khs'])->name('showpdf_khs');

Route::GET('/smart', [smartController::class, 'smart'])->name('smart');

Route::GET('/smartpc', [smartpcController::class, 'smart'])->name('smartpc');

Route::GET('/smartit', [smartITController::class, 'smart'])->name('smartit');

Route::GET('/test', [smartController::class, 'test'])->name('test');

Route::GET('/testpc', [smartpcController::class, 'testpc'])->name('testpc');

Route::GET('/testit', [smartITController::class, 'testit'])->name('testit');


//CREATE DATA MAHASISWA
// Route::resource("/alternatif", adminController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
