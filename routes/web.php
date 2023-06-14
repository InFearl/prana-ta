<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\PesananController;
use GuzzleHttp\Middleware;

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

route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});

route::controller(PemasukanController::class)->group(function () {
    Route::get('/pemasukan', 'index')->name('pemasukan');
    Route::get('/tambah.pemasukan', 'create')->name('tambah.pemasukan');
    Route::get('/simpan.pemasukan', 'store')->name('simpan.pemasukan');
    Route::get('/ubah.pemasukan/{id}', 'edit')->name('ubah.pemasukan');
    Route::post('/update.pemasukan/{id}', 'update')->name('update.pemasukan');
    Route::get('/delete.pemasukan/{id}', 'destroy')->name('delete.pemasukan');
    Route::get('/cetak.pemasukan', 'cetakpemasukan')->name('cetak.pemasukan');
    Route::post('/add.pemasukan', 'addListPemasukan')->name('add.pemasukan');
    Route::get('/show.pemasukan/{id}', 'show')->name('show.pemasukan');
    Route::get('/destroy.pemasukan/{id}', 'destroyItemTemp')->name('destroy.pemasukan');
});

route::controller(PenggunaanController::class)->group(function () {
    Route::get('/penggunaan', 'index')->name('penggunaan');
    Route::get('/tambah.penggunaan', 'create')->name('tambah.penggunaan');
    Route::get('/simpan.penggunaan', 'store')->name('simpan.penggunaan');
    Route::get('/ubah.penggunaan/{id}', 'edit')->name('ubah.penggunaan');
    Route::post('/update.penggunaan/{id}', 'update')->name('update.penggunaan');
    Route::get('/delete.penggunaan/{id}', 'destroy')->name('delete.penggunaan');
    Route::get('/cetak.penggunaan', 'cetakpenggunaan')->name('cetak.penggunaan');
    Route::post('/add.penggunaan', 'addListPenggunaan')->name('add.penggunaan');
    Route::get('/show.penggunaan/{id}', 'show')->name('show.penggunaan');
    Route::get('/destroy.penggunaan/{id}', 'destroyItemTemp')->name('destroy.penggunaan');
});

route::controller(PersediaanController::class)->group(function () {
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
});

route::controller(PemesananController::class)->group(function () {
    Route::get('/pemesanan', 'index')->name('pemesanan');
    Route::get('/tambah.pemesanan', 'create')->name('tambah.pemesanan');
    Route::get('/simpan.pemesanan', 'store')->name('simpan.pemesanan');
    Route::get('/ubah.pemesanan/{id}', 'edit')->name('ubah.pemesanan');
    Route::post('/update.pemesanan/{id}', 'update')->name('update.pemesanan');
    Route::get('/delete.pemesanan/{id}', 'destroy')->name('delete.pemesanan');
    Route::get('/cetak.pemesanan', 'cetakpemesanan')->name('cetak.pemesanan');
    Route::post('/add.pemesanan', 'addListPemesanan')->name('add.pemesanan');
    Route::post('/eoq.pemesanan', 'hitungEOQ')->name('eoq.pemesanan');
    Route::get('/show.pemesanan/{id}', 'show')->name('show.pemesanan');
    Route::get('/destroy.pemesanan/{id}', 'destroyItemTemp')->name('destroy.pemesanan');
    Route::post('/ubahjumlah.pemesanan', 'ubahJumlah')->name('ubahjumlah.pemesanan');
    Route::get('/changestatus.pemesanan/{id}', 'ChangeStatus')->name('changestatus.pemesanan');
});

route::controller(PesananController::class)->group(function () {
    Route::get('/pesanan', 'index')->name('pesanan');
    Route::get('/tambah.pesanan', 'create')->name('tambah.pesanan');
    Route::post('/simpan.pesanan', 'store')->name('simpan.pesanan');
    Route::get('/ubah.pesanan/{id}', 'edit')->name('ubah.pesanan');
    Route::post('/update.pesanan/{id}', 'update')->name('update.pesanan');
    Route::get('/delete.pesanan/{id}', 'destroy')->name('delete.pesanan');
    Route::get('/cetak.pesanan', 'cetakpesanan')->name('cetak.pesanan');
});

route::controller(PersediaanController::class)->group(function () {
    Route::get('/persediaan', 'index')->name('persediaan');
});


Route::get('/login', function () {
    return view('fumigator.pages.auth.index');
})->name('login');

Route::get('/postlogin', 'LoginController@postlogin')->name('postlogin');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout.post');

    // Route::middleware('user')->group(function () {
    //     Route::get('/logout', 'logout')->name('logout.post');
    // });
});
