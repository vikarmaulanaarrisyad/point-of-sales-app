<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk1 = new Produk();
        $produk1->provider_id = 1;
        $produk1->nama_produk = "Telkomsel 5 GB/bulan";
        $produk1->harga_jual = 34000;
        $produk1->harga_beli = 30000;
        $produk1->stok_awal = 0;
        $produk1->stok_akhir = 0;
        $produk1->stok_saat_ini = 0;
        $produk1->laba = $produk1->harga_jual - $produk1->harga_beli;
        $produk1->save();
    }
}
