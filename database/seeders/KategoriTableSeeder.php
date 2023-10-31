<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori1 = new Kategori();
        $kategori1->nama_kategori = 'Pulsa';
        $kategori1->keterangan = 'pulsa';
        $kategori1->save();

        $kategori2 = new Kategori();
        $kategori2->nama_kategori = 'Token Listrik';
        $kategori2->keterangan = 'token listrik';
        $kategori2->save();
    }
}
