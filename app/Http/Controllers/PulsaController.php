<?php

namespace App\Http\Controllers;

use App\Models\Pulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PulsaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pulsa.index');
    }

    /**
     * Get data pulsa
     */
    public function data()
    {
        $query = Pulsa::with('provider')->latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('provider', function ($pulsa) {
                return $pulsa->provider->nama_provider ?? '-';
            })
            ->addColumn('nominal', function ($pulsa) {
                return format_uang($pulsa->nominal);
            })
            ->addColumn('harga_jual', function ($pulsa) {
                return format_uang($pulsa->harga_jual);
            })
            ->addColumn('harga_beli', function ($pulsa) {
                return format_uang($pulsa->harga_beli);
            })
            ->addColumn('aksi', function ($query) {
                return '
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('pulsa.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('pulsa.destroy', $query->id) . '`,`' . $query->nominal . '`)"><i class="fas fa-trash"></i></button>
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
            'provider' => 'required',
            'nominal' => 'required|regex:/^[0-9.]+$/',
            'harga_beli' => 'required|regex:/^[0-9.]+$/',
            'harga_jual' => 'required|regex:/^[0-9.]+$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'provider_id' => $request->provider,
            'nominal' => str_replace('.', '', $request->nominal),
            'harga_beli' => str_replace('.', '', $request->harga_beli),
            'harga_jual' => str_replace('.', '', $request->harga_jual),
        ];

        Pulsa::create($data);

        return response()->json(['data' => $data, 'message' => 'Data pulsa berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pulsa $pulsa)
    {
        $pulsa->provider = $pulsa->provider;
        $pulsa->nominal = format_uang($pulsa->nominal);
        $pulsa->harga_beli = format_uang($pulsa->harga_beli);
        $pulsa->harga_jual = format_uang($pulsa->harga_jual);
        return response()->json(['data' => $pulsa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pulsa $pulsa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pulsa $pulsa)
    {
        $rules = [
            'provider' => 'required',
            'nominal' => 'required|regex:/^[0-9.]+$/',
            'harga_beli' => 'required|regex:/^[0-9.]+$/',
            'harga_jual' => 'required|regex:/^[0-9.]+$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'provider_id' => $request->provider,
            'nominal' => str_replace('.', '', $request->nominal),
            'harga_beli' => str_replace('.', '', $request->harga_beli),
            'harga_jual' => str_replace('.', '', $request->harga_jual),
        ];

        $pulsa->update($data);

        return response()->json(['data' => $data, 'message' => 'Data pulsa berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pulsa $pulsa)
    {
        $pulsa->delete();

        return response()->json(['data' => NULL, 'message' => 'Data pulsa berhasil dihapus']);
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $pulsa = Pulsa::with('provider')->where('nominal', 'LIKE', "%$keyword%")->get();
        return $pulsa;
    }
}
