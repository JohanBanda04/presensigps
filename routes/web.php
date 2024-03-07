<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasatkerController;
use App\Http\Controllers\DepartemenControlller;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

/*hanya bisa diakses oleh guest*/
Route::middleware(['guest:satker'])->group(function(){
    Route::get('/panelsatker',function(){
        return view('auth.loginsatker');
    })->name('loginsatker');

    Route::post('/prosesloginsatker',[AuthController::class,'prosesloginsatker']);
});





/*hanya bisa diakses oleh guest*/
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/presensi/create',[PresensiController::class,'create']);
    Route::post('/presensi/store',[PresensiController::class,'store']);
    Route::get('/editprofile',[PresensiController::class,'editprofile']);
    Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);
    Route::get('/presensi/histori',[PresensiController::class,'histori']);
    Route::post('/gethistori',[PresensiController::class,'gethistori']);

    Route::get('/presensi/izin',[PresensiController::class,'izin']);
    Route::get('/presensi/buatizin',[PresensiController::class,'buatizin']);
    Route::post('/presensi/storeizin',[PresensiController::class,'storeizin']);

    Route::post('/presensi/cekpengajuanizin',[PresensiController::class,'cekpengajuanizin']);


});


//Route::middleware(['auth:satker'])->group(function(){
//    Route::get('/proseslogoutsatker',[AuthController::class,'proseslogoutsatker']);
//    Route::get('panelsatker/dashboardsatker',[DashboardController::class,'dashboardsatker']);
//});
/*hanya utk satker yang terotentikasi*/

/*Hanya untuk user yang telah terotentikasi*/
Route::middleware(['auth:satker','checkrole'])->group(function(){
    Route::get('/proseslogoutsatker',[AuthController::class,'proseslogoutsatker']);
    Route::get('/panelsatker/dashboardsatker',[DashboardController::class,'dashboardsatker']);

    //DataUser
    Route::get('/datasatker',[DatasatkerController::class,'index']);
    Route::post('/satker/store',[DatasatkerController::class,'store']);
    Route::post('/satker/edit',[DatasatkerController::class,'edit']);
    Route::post('/satker/{id}/update',[DatasatkerController::class,'update']);
    Route::post('/satker/{id}/delete',[DatasatkerController::class,'delete']);

    //Data Berita Satker
    Route::get('/datasatker/{kode_satker}/getberita',[DatasatkerController::class,'getberita']);
    Route::post('/datasatker/storeberita',[DatasatkerController::class,'storeberita']);
    Route::post('/datasatker/tampilkandetailberita',[DatasatkerController::class,'tampilkandetailberita']);
    Route::post('/datasatker/{id_berita}/{kode_satker}/deleteberita',[DatasatkerController::class,'deleteberita']);
    Route::post('/datasatker/editberita',[DatasatkerController::class,'editberita']);
    Route::post('/datasatker/editberita/hapuslink',[DatasatkerController::class,'hapuslink']);
    Route::post('/datasatker/editberita/hapuslink_nasional',[DatasatkerController::class,'hapuslink_nasional']);
    Route::post('/datasatker/{id_beria}/updateberita',[DatasatkerController::class,'updateberita']);
    Route::post('/datasatker/{kode_satker}/getberitabytanggal',[DatasatkerController::class,'getberitabytanggal']);

    Route::get('/beritasatker/laporanberita',[DatasatkerController::class,'laporanberita']);
    Route::post('/beritasatker/cetaklaporanberita',[DatasatkerController::class,'cetaklaporanberita']);
    Route::get('/beritasatker/rekapberita',[DatasatkerController::class,'rekapberita']);
    Route::post('/beritasatker/cetaklaporanberita_rekap',[DatasatkerController::class,'cetaklaporanberita_rekap']);

});
/*Hanya untuk user yang telah terotentikasi*/
Route::middleware(['auth:user'])->group(function(){
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    Route::get('panel/dashboardadmin',[DashboardController::class,'dashboardadmin']);

    //Karyawan
    Route::get('/karyawan',[KaryawanController::class,'index']);
    Route::post('/karyawan/store',[KaryawanController::class,'store']);
    Route::post('/karyawan/edit',[KaryawanController::class,'edit']);
    Route::post('/karyawan/{nik}/update',[KaryawanController::class,'update']);
    Route::post('/karyawan/{nik}/delete',[KaryawanController::class,'delete']);

    //Departemen
    Route::get('/departemen',[DepartemenControlller::class,'index']);
    Route::post('/departemen/store',[DepartemenControlller::class,'store']);
    Route::post('/departemen/edit',[DepartemenControlller::class,'edit']);
    Route::post('/departemen/{kode_dept}/update',[DepartemenControlller::class,'update']);
    Route::post('/departemen/{kode_dept}/delete',[DepartemenControlller::class,'delete']);

    //Presensi
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getpresensi',[PresensiController::class,'getpresensi']);
    Route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporan',[PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
    Route::get('/presensi/rekap',[PresensiController::class,'rekap']);
    Route::post('/presensi/cetakrekap',[PresensiController::class,'cetakrekap']);
    Route::get('/presensi/izinsakit',[PresensiController::class,'izinsakit']);
    Route::post('/presensi/approveizinsakit',[PresensiController::class,'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit',[PresensiController::class,'batalkanizinsakit']);

    //Cabang
    Route::get('/cabang',[CabangController::class,'index']);
    Route::post('/cabang/store',[CabangController::class,'store']);
    Route::post('/cabang/edit',[CabangController::class,'edit']);
    Route::post('/cabang/update',[CabangController::class,'update']);
    Route::post('/cabang/{kode_cabang}/delete',[CabangController::class,'delete']);

    //Konfigurasi
    Route::get('/konfigurasi/lokasikantor',[KonfigurasiController::class,'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class,'updatelokasikantor']);
    Route::get('/konfigurasi/jamkerja',[KonfigurasiController::class,'jamkerja']);
    Route::post('/konfigurasi/storejamkerja',[KonfigurasiController::class,'storejamkerja']);
    Route::post('/konfigurasi/editjamkerja',[KonfigurasiController::class,'editjamkerja']);
    Route::post('/konfigurasi/updatejamkerja',[KonfigurasiController::class,'updatejamkerja']);
    Route::post('/konfigurasi/{kode_jam_kerja}/delete',[KonfigurasiController::class,'deletejamkerja']);


});

