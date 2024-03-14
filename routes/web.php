<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CetakpenjualanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Middleware\CheckIfUserTableIsEmpty;
use App\Http\Controllers\DetailPenjualanController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;



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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([CheckIfUserTableIsEmpty::class])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
});
Route::group(['middleware' => 'auth'], function () {
    //Halaman Pertama yang diakses ketika ada yang login
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

    //Route yang hanya bisa diakses oleh admin
    Route::group(['middleware' => 'admin'], function () {
        //Halaman Dashboard
        Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

        //Management Category
        Route::resource('/category', CategoryController::class);

        //Management Product
        Route::resource('/product', ProductController::class);
        Route::delete('/selected-product', [ProductController::class, 'deleteAll'])->name('product.delete');
        Route::post('/product-cetak-barcode', [ProductController::class, 'cetakBarcode'])->name('product.cetak_barcode');

        //Management Member
        Route::resource('/member', MemberController::class);

        //Management Penjualan
        Route::resource('/penjualan', PenjualanController::class);
        Route::get('/penjualan/create/{id_penjualan}', [PenjualanController::class, 'create']);
        Route::get('/penjualan/detail/{id_penjualan}', [DetailPenjualanController::class, 'show']);
        Route::post('/penjualan/detail/create', [DetailPenjualanController::class, 'create']);
        Route::get('/penjualan/detail/delete', [DetailPenjualanController::class, 'delete']);
        Route::get('/penjualan/detail/cetak-pdf/{id_penjualan}', [DetailPenjualanController::class, 'viewPdf']);
        Route::get('/penjualan/detail/selesai/{id_penjualan}', [DetailPenjualanController::class, 'done']);
        Route::get('cetak-penjualan', [PenjualanController::class, 'cetakform'])->name('cetak-penjualan');
        Route::get('cetak-penjualan-pertanggal/{tglawal}/{tglakhir}', [PenjualanController::class, 'cetakPenjualan'])->name('cetak-penjualan-pertanggal');

        //Management Users
        Route::resource('/users', UsersController::class)->middleware('admin');
    });

    // Route yang hanya bisa diakses oleh Petugas
    Route::group(['middleware' => 'petugas'], function () {
        // Halaman Dashboard
        Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

        // Management Product
        Route::resource('/product', ProductController::class);
        Route::delete('/selected-product', [ProductController::class, 'deleteAll'])->name('product.delete');
        Route::post('/product-cetak-barcode', [ProductController::class, 'cetakBarcode'])->name('product.cetak_barcode');

        // Management Penjualan
        Route::resource('/penjualan', PenjualanController::class);
        Route::get('/penjualan/create/{id_penjualan}', [PenjualanController::class, 'create']);
        Route::get('/penjualan/detail/{id_penjualan}', [DetailPenjualanController::class, 'show']);
        Route::post('/penjualan/detail/create', [DetailPenjualanController::class, 'create']);
        Route::get('/penjualan/detail/delete', [DetailPenjualanController::class, 'delete']);
        Route::get('/penjualan/detail/cetak-pdf/{id_penjualan}', [DetailPenjualanController::class, 'viewPdf']);
        Route::get('/penjualan/detail/selesai/{id_penjualan}', [DetailPenjualanController::class, 'done']);
        Route::get('cetak-penjualan', [PenjualanController::class, 'cetakform'])->name('cetak-penjualan');
        Route::get('cetak-penjualan-pertanggal/{tglawal}/{tglakhir}', [PenjualanController::class, 'cetakPenjualan'])->name('cetak-penjualan-pertanggal');
    });
    // Route::group(['middleware' => 'auth'], function () {
});
