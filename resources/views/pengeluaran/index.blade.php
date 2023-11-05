@extends('layouts.app')

@section('title', 'Data Pengeluaran')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pengeluaran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 col-md-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-sm btn-primary" onclick="addData(`{{ route('pengeluaran.store') }}`)"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th style="width: 6%">No</th>
                        <th>Tanggal</th>
                        <th>Diskripsi</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @include('pengeluaran.form')
@endsection

@include('includes.datatables')
@include('pengeluaran.scripts')
