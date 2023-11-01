@extends('layouts.app')

@section('title', 'Provider')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Provider</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12 col-md-12">
            <x-card>
                <x-slot name="header">
                    <button class="btn btn-sm btn-primary" onclick="addData(`{{ route('provider.store') }}`)"><i
                            class="fas fa-plus-circle"></i> Tambah Provider</button>
                </x-slot>

                <x-table>
                    <x-slot name="thead">
                        <th style="width: 6%">No</th>
                        <th>Nama Provider</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @include('provider.form')
@endsection

@include('includes.datatables')
@include('provider.scripts')
