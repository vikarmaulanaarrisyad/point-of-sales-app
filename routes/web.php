<?php

use App\Http\Controllers\{
    DashboardController,
    PelangganController,
    PembelianController,
    ProviderController,
    ProdukController,
    PulsaController,
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
    return view('auth.login');
});

Route::group([
    'middleware' => ['auth', 'role:super-admin'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Pelanggan
    Route::get('/pelanggan/data', [PelangganController::class, 'data'])->name('pelanggan.data');
    Route::resource('/pelanggan', PelangganController::class);

    // Provider
    Route::get('/provider/data', [ProviderController::class, 'data'])->name('provider.data');
    Route::resource('/provider', ProviderController::class);
    Route::get('/ajax/provider/search', [ProviderController::class, 'search'])->name('provider.search');

    // Pulsa
    Route::get('/pulsa/data', [PulsaController::class, 'data'])->name('pulsa.data');
    Route::resource('/pulsa', PulsaController::class);

    // Produk
    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::resource('/produk', ProdukController::class)->except('edit');
    Route::get('/produk/{produk}/detail', [ProdukController::class, 'detail'])->name('produk.detail');
    Route::get('/ajax/produk/search', [ProdukController::class, 'search'])->name('produk.search');


    // Pembelian
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::resource('/pembelian', PembelianController::class);
});
