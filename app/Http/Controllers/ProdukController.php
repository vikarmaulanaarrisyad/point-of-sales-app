<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produk.index');
    }

    public function data()
    {
        $query = Produk::with('provider')->latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('provider', function ($produk) {
                return $produk->provider->nama_provider ?? '-';
            })
            ->editColumn('harga_jual', function ($produk) {
                return format_uang($produk->harga_jual);
            })
            ->editColumn('harga_beli', function ($produk) {
                return format_uang($produk->harga_beli);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <button class="btn btn-sm btn-success" onclick="detailData(`' . route('produk.detail', $produk->id) . '`,`' . $produk->nama_produk . '`)"><i class="fas fa-eye"></i></button>
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('produk.show', $produk->id) . '`)"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('produk.destroy', $produk->id) . '`,`' . $produk->nama_produk . '`)"><i class="fas fa-trash"></i></button>
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
            'nama_produk' => 'required|min:1',
            'harga_jual' => 'required|regex:/^[0-9.]+$/',
            'harga_beli' => 'required|regex:/^[0-9.]+$/',
            'stok_awal' => 'required',
            'provider' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $hargaJual = str_replace('.', '', $request->harga_jual);
        $hargaBeli = str_replace('.', '', $request->harga_beli);
        $data = [
            'kode_produk' => 'P-' . rand(10000, 100000000),
            'nama_produk' => $request->nama_produk,
            'harga_jual' => $hargaJual,
            'harga_beli' => $hargaBeli,
            'stok_awal' => $request->stok_awal,
            'provider_id' => $request->provider,
            'laba' => $hargaJual - $hargaBeli,
            'stok_awal' => $request->stok_awal ?? 0,
            'stok_akhir' => $request->stok_awal ?? 0,
            'stok_saat_ini' => $request->stok_awal ?? 0,
        ];

        Produk::create($data);

        return response()->json(['data' => $data, 'message' => 'Data produk berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $produk->provider = $produk->provider;
        $produk->harga_jual = format_uang($produk->harga_jual);
        $produk->harga_beli = format_uang($produk->harga_beli);
        return response()->json(['data' => $produk]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail(Produk $produk)
    {
        $produk->provider = $produk->provider;
        $produk->harga_beli = format_uang($produk->harga_beli);
        $produk->harga_jual = format_uang($produk->harga_jual);
        $produk->stok = format_uang($produk->stok_akhir);
        $produk->laba = format_uang($produk->laba);
        return $produk;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $rules = [
            'nama_produk' => 'required|min:1',
            'harga_jual' => 'required|regex:/^[0-9.]+$/',
            'harga_beli' => 'required|regex:/^[0-9.]+$/',
            'stok_awal' => 'required',
            'provider' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data gagal tersimpan, pastikan isian anda benar.'], 422);
        }

        $hargaJual = str_replace('.', '', $request->harga_jual);
        $hargaBeli = str_replace('.', '', $request->harga_beli);
        $data = [
            'kode_produk' => 'P-' . rand(10000, 100000000),
            'nama_produk' => $request->nama_produk,
            'harga_jual' => $hargaJual,
            'harga_beli' => $hargaBeli,
            'stok_awal' => $request->stok_awal,
            'provider_id' => $request->provider,
            'laba' => $hargaJual - $hargaBeli,
            'stok_awal' => $request->stok_awal ?? 0,
            'stok_akhir' => $request->stok_awal ?? 0,
            'stok_saat_ini' => $request->stok_awal ?? 0,
        ];

        $produk->update($data);

        return response()->json(['data' => $data, 'message' => 'Data produk berhasil diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return response()->json(['data' => NULL, 'message' => 'Data produk berhasil dihapus']);
    }

    function search(Request $request)
    {
        $keyword = $request->get('q');

        $produk = Produk::where('nama_produk', 'LIKE', "%$keyword%")->get();

        return $produk;
    }
}
