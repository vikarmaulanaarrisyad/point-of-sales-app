<?php

use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    ProdukController,
};
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
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'role:super-admin'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Kategori
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('/kategori', KategoriController::class);
    Route::get('/ajax/kategori/search', [KategoriController::class, 'search'])->name('kategori.search');

    // Produk
    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::resource('/produk', ProdukController::class)->except('edit');
    Route::get('/produk/{produk}/detail', [ProdukController::class, 'detail'])->name('produk.detail');
});
