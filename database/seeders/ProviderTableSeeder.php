<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $telkomsel = new Provider();
        $telkomsel->nama_provider = 'Telkomsel';
        $telkomsel->keterangan = '-';
        $telkomsel->save();

        $Axis = new Provider();
        $Axis->nama_provider = 'Axis';
        $Axis->keterangan = '-';
        $Axis->save();

        $Indosat = new Provider();
        $Indosat->nama_provider = 'Indosat';
        $Indosat->keterangan = '-';
        $Indosat->save();

        $xlaxia = new Provider();
        $xlaxia->nama_provider = 'XL Axia';
        $xlaxia->keterangan = '-';
        $xlaxia->save();
    }
}
