<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('provider.index');
    }

    /**
     * Get data provider
     */
    public function data()
    {
        $query = Provider::latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('provider.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('provider.destroy', $query->id) . '`,`' . $query->nama_provider . '`)"><i class="fas fa-trash"></i></button>
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
            'nama_provider' => 'required|min:1',
            'keterangan' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_provider' => $request->nama_provider,
            'keterangan' => $request->keterangan ?? '-',
        ];

        Provider::create($data);

        return response()->json(['data' => $data, 'message' => 'Data provider berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        return response()->json(['data' => $provider]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $rules = [
            'nama_provider' => 'required|min:1',
            'keterangan' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $data = [
            'nama_provider' => $request->nama_provider,
            'keterangan' => $request->keterangan ?? '-',
        ];

        $provider->update($data);

        return response()->json(['data' => $data, 'message' => 'Data provider berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();

        return response()->json(['data' => NULL, 'message' => 'Data provider berhasil dihapus']);
    }

    function search(Request $request)
    {
        $keyword = $request->get('q');

        $provider = Provider::where('nama_provider', "LIKE", "%$keyword%")->get();

        return $provider;
    }
}
