<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\SaldoPulsa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $saldoPulsa = SaldoPulsa::first();
        $jumlahVocer = Produk::sum('stok_akhir');

        return view('dashboard', compact('saldoPulsa','jumlahVocer'));
    }
}
