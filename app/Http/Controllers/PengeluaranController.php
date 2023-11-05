<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengeluaran.index');
    }

    function data(Request $request)
    {
        $query = Pengeluaran::latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('tanggal_pengeluaran', function ($query) {
                return tanggal_indonesia($query->tanggal_pengeluaran);
            })
            ->editColumn('total_pengeluaran', function ($query) {
                return format_uang($query->total_pengeluaran);
            })
            ->addColumn('aksi', function ($query) {
                return '
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('pengeluaran.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('pengeluaran.destroy', $query->id) . '`,`' . $query->keterangan . '`)"><i class="fas fa-trash"></i></button>
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
            'keterangan' => 'required|min:3',
            'total_pengeluaran' => 'required|regex:/^[0-9.]+$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa kembali inputan anda'], 422);
        }

        $data = [
            'tanggal_pengeluaran' => date('Y-m-d'),
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => str_replace('.', '', $request->total_pengeluaran),
        ];

        Pengeluaran::create($data);

        return response()->json(['data' => $data, 'message' => 'Data pengeluaran berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        $pengeluaran->total_pengeluaran = format_uang($pengeluaran->total_pengeluaran);
        return response()->json(['data' => $pengeluaran]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $rules = [
            'keterangan' => 'required|min:3',
            'total_pengeluaran' => 'required|regex:/^[0-9.]+$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa kembali inputan anda'], 422);
        }

        $data = [
            'tanggal_pengeluaran' => date('Y-m-d'),
            'keterangan' => $request->keterangan,
            'total_pengeluaran' => str_replace('.', '', $request->total_pengeluaran),
        ];

        $pengeluaran->update($data);

        return response()->json(['data' => $data, 'message' => 'Data pengeluaran berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return response()->json(['message' => 'Data pengeluaran berhasil dihapus']);
    }
}
