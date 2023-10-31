<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Get data kategori
     */
    public function data()
    {
        $query = Kategori::latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('kategori.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('kategori.destroy', $query->id) . '`,`' . $query->nama_kategori . '`)"><i class="fas fa-trash"></i></button>
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
            'nama_kategori' => 'required|min:1',
            'keterangan' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan ?? '-',
        ];

        Kategori::create($data);

        return response()->json(['data' => $data, 'message' => 'Data kategori berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return response()->json(['data' => $kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $rules = [
            'nama_kategori' => 'required|min:1',
            'keterangan' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan ?? '-',
        ];

        $kategori->update($data);

        return response()->json(['data' => $data, 'message' => 'Data kategori berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json(['data' => NULL, 'message' => 'Data kategori berhasil dihapus']);
    }
}
