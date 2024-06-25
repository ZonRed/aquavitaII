<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\LaporanController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


//route Promo
Route::get('/Promo', function () {
    return view('pengguna.Promo');
});

//route Kontak
Route::get('/Kontak', function () {
    return view('pengguna.Kontak');
});

//route register

Route::post('/simpanuser', 'App\Http\Controllers\Authcontroller@simpanuser');

//route login

Route::post('/checklogin', 'App\Http\Controllers\Authcontroller@checklogin');

//route logout
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');

//-----------------
//route jadwal
Route::get('/D_Jadwal', 'App\Http\Controllers\JadwalController@Jadwal')->middleware('auth');;
Route::get('/D_InputJadwal', 'App\Http\Controllers\JadwalController@InputJadwal')->middleware('auth');;
Route::post('/SaveJadwal', [JadwalController::class, 'SaveJadwal'])->middleware('auth');;

//route delete jadwal
Route::get('/delete_Jadwal/{id}', 'App\Http\Controllers\JadwalController@delete_Jadwal')->middleware('auth');

// Route untuk penghapusan semua jadwal
Route::get('/delete_all_Jadwal', 'App\Http\Controllers\JadwalController@deleteAll_Jadwal')->middleware('auth');


// route untuk menampilkan formulir edit jadwal
Route::get('/edit_Jadwal/{id}', 'App\Http\Controllers\JadwalController@edit_Jadwal')->middleware('auth');

// route untuk menyimpan jadwal edit
Route::post('/update_Jadwal/{id}', 'App\Http\Controllers\JadwalController@update_Jadwal')->middleware('auth');

//route pengguna_Jadwal
Route::get('/Jadwal', 'App\Http\Controllers\JadwalController@pengguna_Jadwal');

//pencarian pengguna jadwal
Route::get('/Jadwal', 'App\Http\Controllers\JadwalController@pencarianpenggunajadwal');
//pencarian admin jadwal
Route::get('/pencarianadminjadwal', 'App\Http\Controllers\JadwalController@pencarianadminjadwal')->name('pencarianadminjadwal')->middleware('auth');


//-----------------
//route jual
Route::get('/D_Jual', 'App\Http\Controllers\JualController@Jual')->middleware('auth');;
Route::get('/D_InputJual', 'App\Http\Controllers\JualController@InputJual')->middleware('auth');;
Route::post('/SaveJual', [JualController::class, 'SaveJual'])->middleware('auth');;

//route delete jual
Route::get('/delete_Jual/{id}', 'App\Http\Controllers\JualController@delete_Jual')->middleware('auth');

//route delete all jual
Route::get('/delete_all_Jual', 'App\Http\Controllers\JualController@deleteAll_Jual')->middleware('auth')->name('delete_all_Jual');

// route untuk menampilkan formulir edit jual
Route::get('/edit_Jual/{id}', 'App\Http\Controllers\JualController@edit_Jual')->middleware('auth');

// route untuk menyimpan jual edit
Route::post('/update_Jual/{id}', 'App\Http\Controllers\JualController@update_Jual')->middleware('auth');

//route pengguna_Jual
Route::get('/Jual', 'App\Http\Controllers\JualController@pengguna_Jual');

//pencarian pengguna jual
Route::get('/Jual', 'App\Http\Controllers\JualController@pencarianpenggunajual');
//pencarian admin jual
Route::get('/D_Jual', 'App\Http\Controllers\JualController@pencarianadminjual')->middleware('auth');


//-----------------
//route promo
Route::get('/D_Promo', 'App\Http\Controllers\PromoController@Promo')->middleware('auth');;
Route::get('/D_InputPromo', 'App\Http\Controllers\PromoController@InputPromo')->middleware('auth');;
Route::post('/SavePromo', [PromoController::class, 'SavePromo'])->middleware('auth');;

//route delete promo
Route::get('/delete_Promo/{id}', 'App\Http\Controllers\PromoController@delete_Promo')->middleware('auth');

// route delete all promo
Route::get('/delete_all_Promo', 'App\Http\Controllers\PromoController@deleteAll_Promo')->middleware('auth')->name('delete_all_Promo');


// route untuk menampilkan formulir edit promo
Route::get('/edit_Promo/{id}', 'App\Http\Controllers\PromoController@edit_Promo')->middleware('auth');

// route untuk menyimpan promo edit
Route::post('/update_Promo/{id}', 'App\Http\Controllers\PromoController@update_Promo')->middleware('auth');

//route pengguna_Promo
Route::get('/Promo', 'App\Http\Controllers\PromoController@pengguna_Promo');

//pencarian pengguna jual
Route::get('/Promo', 'App\Http\Controllers\PromoController@pencarianpenggunaPromo');

//pencarian admin jual
Route::get('/D_Promo', 'App\Http\Controllers\PromoController@pencarianadminPromo')->middleware('auth');

// //route jadwal
// Route::get('/D_Jadwal', 'App\Http\Controllers\JadwalController@Jadwal');
// Route::get('/D_InputJadwal', 'App\Http\Controllers\JadwalController@InputJadwal');
// Route::post('/SaveJadwal', [JadwalController::class, 'SaveJadwal']);

// //route delete jadwal
// Route::get('/delete_jadwal/{id}', 'App\Http\Controllers\JadwalController@delete_jadwal')->middleware('auth');

// // route untuk menampilkan formulir edit hasil
// Route::get('/edit_jadwal/{id}', 'App\Http\Controllers\JadwalController@edit_jadwal')->middleware('auth');

// // route untuk menyimpan hasil edit
// Route::post('/update_jadwal/{id}', 'App\Http\Controllers\JadwalController@update_jadwal')->middleware('auth');

// //route pengguna_jadwal
// Route::get('/next', 'App\Http\Controllers\JadwalController@pengguna_jadwal');


// //route statistik
// Route::get('/D_Statistik', 'App\Http\Controllers\StatistikController@Statistik');
// Route::get('/D_InputStatistik', 'App\Http\Controllers\StatistikController@InputStatistik');
// Route::post('/SaveStatistik', [StatistikController::class, 'SaveStatistik']);

// //route delete statistik
// Route::get('/delete_statistik/{id}', 'App\Http\Controllers\StatistikController@delete_statistik')->middleware('auth');

// // route untuk menampilkan formulir edit statistik
// Route::get('/edit_statistik/{id}', 'App\Http\Controllers\StatistikController@edit_statistik')->middleware('auth');

// // route untuk menyimpan statistik edit
// Route::post('/update_statistik/{id}', 'App\Http\Controllers\StatistikController@update_statistik')->middleware('auth');

// //route pengguna_statistik
// Route::get('/statistik', 'App\Http\Controllers\StatistikController@pengguna_statistik');


//route laporan
Route::get('/D_Laporan', 'App\Http\Controllers\LaporanController@Laporan')->middleware('auth');
Route::get('/', 'App\Http\Controllers\LaporanController@InputLaporan');
Route::post('/SaveLaporan', [LaporanController::class, 'SaveLaporan']);

//pencarian admin laporan
Route::get('/pencarianadmin', [LaporanController::class, 'pencarianadmin'])->name('pencarianadmin');


//route delete laporan
Route::get('/delete_Laporan/{id}', 'App\Http\Controllers\LaporanController@delete_Laporan')->middleware('auth');

//route delete all laporan
Route::get('/delete_all_Laporan', [LaporanController::class, 'deleteAllLaporan'])->middleware('auth')->name('delete_all_laporan');


Route::middleware('auth')->group(function () {
    Route::get('/Dashboard', function () {
        return view('admin.Dashboard');
    });
});




require __DIR__ . '/auth.php';
