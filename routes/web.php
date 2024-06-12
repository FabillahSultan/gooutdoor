<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DaftarUserController;
use App\Http\Controllers\StatistikController;
use Random\Randomizer;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop/{user_id}',[HomeController::class, 'Produkbyiduser'])->name('user.produk');


Auth::routes(['verify'=>true]);
   
//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
   
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/shop/{user_id}',[HomeController::class, 'Produkbyiduser'])->name('user.produk');
    Route::get('/detail/{name_user}/{id_user_enkription}',[HomeController::class, 'Produkbyiduser1']);
    Route::get('/detailpesanan', [HomeController::class, 'detailpesanan'])->name('detailpesanan');
    Route::post('/transaksi', [TransaksiController::class, 'create'])->name('transaksi');
    Route::get('/detailtransaksi', [TransaksiController::class, 'gettransaksi'])->name('gettransaksi');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produkadmin.index');
        Route::match(['post', 'get'], '/create', [ProdukController::class, 'create'])->name('adminproduk.create');
        Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('adminproduk.edit');
        Route::post('store', [ProdukController::class, 'store'])->name('adminproduk.store');
        Route::patch('/produk/update/{id}', [ProdukController::class, 'update'])->name('adminproduk.update');
        Route::delete('destroy/{id}', [ProdukController::class, 'destroy'])->name('adminproduk.destroy');
    });

    Route::prefix('stock')->group(function () {
        Route::get('/index', [StockController::class, 'index'])->name('adminstock.index');
        Route::get('create', [StockController::class, 'create'])->name('adminstock.create');
        Route::post('store', [StockController::class, 'store'])->name('adminstock.store');
        Route::get('edit/{id}', [StockController::class, 'edit'])->name('adminstock.edit');
        Route::patch('stock/update/{id}', [StockController::class, 'update'])->name('adminstock.update');
        Route::delete('destroy/{id}', [StockController::class, 'destroy'])->name('adminstock.destroy');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('adminprofile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('adminprofile.edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('adminprofile.update');
    });
    
    Route::get('/pengajuansewa/{id_pesanan}', [TransaksiController::class, 'pengajuansewa'])->name('admin.pengajuansewa');
    Route::post('/pengajuansewa/{id}/ubah-status', [TransaksiController::class, 'ubahStatus'])->name('admin.pengajuansewastatus');
    Route::get('/statistikpenjualan/{id_pesanan}', [TransaksiController::class, 'gettransaksiadmin'])->name('admin.statistikpenjualanproduk');
    Route::get('/statistikpendapatan/{id_pesanan}', [TransaksiController::class, 'gettransaksiadminpendapatan'])->name('admin.statistikpendapatan');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:manager'])->group(function () {
   
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

    Route::prefix('usertoko')->group(function () {
    Route::get('/manager/daftartoko', [DaftarUserController::class, 'daftartoko'])->name('manager.daftartoko');
    Route::delete('destroy/{id}', [DaftarUserController::class, 'destroy'])->name('superadmin.destroy');
    });

    Route::prefix('usercustomer')->group(function () {
    Route::delete('destroy/{id}', [DaftarUserController::class, 'destroycustomer'])->name('superadmin.destroycustomer');
    Route::get('/manager/daftarcustomer', [DaftarUserController::class, 'daftarcustomer'])->name('manager.daftarcustomer');
    });

    Route::get('/statistik', [StatistikController::class, 'getTransaksiAdmin'])->name('superadmin.statistik');
    Route::get('/statistikpendapatan', [StatistikController::class, 'gettransaksiadminpendapatan'])->name('superadmin.statistikpendapatan');
});