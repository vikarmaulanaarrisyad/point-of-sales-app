@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pelanggan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 col-md-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-sm btn-primary" onclick="addData(`{{ route('pelanggan.store') }}`)"><i
                            class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th style="width: 6%">No</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @include('pelanggan.form')
@endsection

@include('includes.datatables')
@include('pelanggan.scripts')
