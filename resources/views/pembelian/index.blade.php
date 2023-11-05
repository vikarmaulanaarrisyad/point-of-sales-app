@extends('layouts.app')

@section('title', 'Data Pembelian')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 col-md-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-sm btn-primary" onclick="addData(`{{ route('pembelian.store') }}`)"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th style="width: 6%">No</th>
                        <th style="width: 17%">Tanggal Transaksi</th>
                        <th style="width: 15%">Kode Transaksi</th>
                        <th style="width: 10%">Produk</th>
                        <th style="width: 10%">Jumlah</th>
                        <th>Nominal</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @include('pembelian.form')
@endsection

@include('includes.datatables')
@include('includes.select2')
@include('pembelian.scripts')
