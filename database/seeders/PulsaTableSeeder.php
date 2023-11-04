<?php

namespace Database\Seeders;

use App\Models\Pulsa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PulsaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pulsa = new Pulsa();
        $pulsa->provider_id = 1;
        $pulsa->nominal = 5000;
        $pulsa->harga_beli = 5000;
        $pulsa->harga_jual = 6500;
        $pulsa->save();

        $pulsa1 = new Pulsa();
        $pulsa1->provider_id = 1;
        $pulsa1->nominal = 10000;
        $pulsa1->harga_beli = 10000;
        $pulsa1->harga_jual = 11000;
        $pulsa1->save();

        $pulsa2 = new Pulsa();
        $pulsa2->provider_id = 1;
        $pulsa2->nominal = 15000;
        $pulsa2->harga_beli = 15000;
        $pulsa2->harga_jual = 16000;
        $pulsa2->save();
    }
}
