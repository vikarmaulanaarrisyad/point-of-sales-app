@extends('layouts.app')

@section('title', 'Produk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 col-md-12 col-sm-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-sm btn-primary" onclick="addData(`{{ route('produk.store') }}`)"><i
                            class="fas fa-plus-circle"></i> Tambah Produk</button>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th style="width: 6%">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @include('produk.form')
@endsection

@include('includes.datatables')
@include('includes.select2')
@include('produk.scripts')
