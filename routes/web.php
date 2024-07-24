<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\PresensiController;
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

Route::middleware(['guest:user'])->group(function() {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class,'prosesloginadmin']);
});

Route::middleware(['guest:murid'])->group(function() {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class,'proseslogin']);
});

Route::middleware(['auth:murid'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class,'proseslogout']);

    //Presensi
    Route::get('/presensi/create', [PresensiController::class,'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    // Edit Profile
    Route::get('/editprofile',[PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class, 'updateprofile']);

    //Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //Izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('/proseslogoutadmin', [AuthController::class,'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin',[DashboardController::class,'dashboardadmin']);

    //Murid
    Route::get('/murid',[MuridController::class,'index']);
    Route::post('/murid/store',[MuridController::class,'store']);
    Route::post('/murid/edit',[MuridController::class,'edit']);
    Route::post('/murid/{nik}/update',[MuridController::class,'update']);
    Route::post('/murid/{nik}/delete',[MuridController::class,'delete']);

    //Jurusan
    Route::get('/jurusan',[JurusanController::class,'index']);
    Route::post('/jurusan/store',[JurusanController::class,'store']);
    Route::post('/jurusan/edit',[JurusanController::class,'edit']);
    Route::post('/jurusan/{kode_jurusan}/update',[JurusanController::class,'update']);
    Route::post('/jurusan/{kode_jurusan}/delete',[JurusanController::class,'delete']);

    //Presensi
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getpresensi',[PresensiController::class,'getpresensi']);
    Route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporan',[PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
});