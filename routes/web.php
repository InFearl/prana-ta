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

route::controller(DashboardController::class)->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

route::controller(PemasukanController::class)->group(function(){
    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::get('/tambah.pemasukan', [PemasukanController::class, 'create'])->name('tambah.pemasukan');
    Route::post('/simpan.pemasukan', [PemasukanController::class, 'store'])->name('simpan.pemasukan');
    Route::get('/ubah.pemasukan/{id}', [PemasukanController::class, 'edit'])->name('ubah.pemasukan');
    Route::post('/update.pemasukan/{id}', [PemasukanController::class, 'update'])->name('update.pemasukan');
    Route::get('/delete.pemasukan/{id}', [PemasukanController::class, 'destroy'])->name('delete.pemasukan');
    Route::get('/cetak.pemasukan', [PemasukanController::class, 'cetakpemasukan'])->name('cetak.pemasukan');
});

route::controller(PenggunaanController::class)->group(function(){
    Route::get('/penggunaan', [PenggunaanController::class, 'index'])->name('penggunaan');
    Route::get('/tambah.penggunaan', [PenggunaanController::class, 'create'])->name('tambah.penggunaan');
    Route::post('/simpan.penggunaan', [PenggunaanController::class, 'store'])->name('simpan.penggunaan');
    Route::get('/ubah.penggunaan/{id}', [PenggunaanController::class, 'edit'])->name('ubah.penggunaan');
    Route::post('/update.penggunaan/{id}', [PenggunaanController::class, 'update'])->name('update.penggunaan');
    Route::get('/delete.penggunaan/{id}', [PenggunaanController::class, 'destroy'])->name('delete.penggunaan');
    Route::get('/cetak.penggunaan', [PenggunaanController::class, 'cetakpenggunaan'])->name('cetak.penggunaan');
    Route::post('/add.penggunaan', [PenggunaanController::class, 'addListPenggunaan'])->name('add.penggunaan');
});

route::controller(PersediaanController::class)->group(function(){
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
});

route::controller(PemesananController::class)->group(function(){
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
    Route::get('/tambah.pemesanan', [PemesananController::class, 'create'])->name('tambah.pemesanan');
    Route::post('/simpan.pemesanan', [PemesananController::class, 'store'])->name('simpan.pemesanan');

});

route::controller(PesananController::class)->group(function(){
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/tambah.pesanan', [PesananController::class, 'create'])->name('tambah.pesanan');
    Route::post('/simpan.pesanan', [PesananController::class, 'store'])->name('simpan.pesanan');
    Route::get('/ubah.pesanan/{id}', [PesananController::class, 'edit'])->name('ubah.pesanan');
    Route::post('/update.pesanan/{id}', [PesananController::class, 'update'])->name('update.pesanan');
    Route::get('/delete.pesanan/{id}', [PesananController::class, 'destroy'])->name('delete.pesanan');
    Route::get('/cetak.pesanan', [PesananController::class, 'cetakpesanan'])->name('cetak.pesanan');
});

route::controller(PersediaanController::class)->group(function(){
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
});


Route::get('/login', function () {
    return view('fumigator.pages.auth.index');
})->name('login');

Route::get('/postlogin', 'LoginController@postlogin')->name('postlogin');

Route::controller(LoginController::class)->group(function (){
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout','logout')->name('logout.post');

    // Route::middleware('user')->group(function () {
    //     Route::get('/logout', 'logout')->name('logout.post');
    // });
});
