<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pelanggan.index');
    }

    /**
     * Get data pelanggan
     */
    public function data()
    {
        $query = Pelanggan::latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('pelanggan.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('pelanggan.destroy', $query->id) . '`,`' . $query->nama_pelanggan . '`)"><i class="fas fa-trash"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_pelanggan' => 'required|min:1',
            'nomor_pelanggan' => 'required|min:11|max:14',
        ];

        $message = [
            'nomor_pelanggan.min' => 'Nomor pelanggan minimal berisi 11 digit.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_pelanggan' => $request->nomor_pelanggan ?? '-',
        ];

        Pelanggan::create($data);

        return response()->json(['data' => $data, 'message' => 'Data pelanggan berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return response()->json(['data' => $pelanggan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $rules = [
            'nama_pelanggan' => 'required|min:1',
            'nomor_pelanggan' => 'required|min:11',
        ];

        $message = [
            'nomor_pelanggan.min' => 'Nomor pelanggan minimal berisi 11 digit.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_pelanggan' => $request->nomor_pelanggan ?? '-',
        ];

        $pelanggan->update($data);

        return response()->json(['data' => $data, 'message' => 'Data pelanggan berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json(['data' => NULL, 'message' => 'Data pelanggan berhasil dihapus']);
    }
}
