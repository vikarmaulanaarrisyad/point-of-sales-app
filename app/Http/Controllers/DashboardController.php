<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\SaldoPulsa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $saldoPulsa = Pembelian::where('produk_id', '0')->orWhere('saldo_pulsa', '!=', '0')->sum('saldo_pulsa');
        $jumlahVocer = Produk::sum('stok_akhir');

        return view('dashboard', compact('saldoPulsa', 'jumlahVocer'));
    }
}
