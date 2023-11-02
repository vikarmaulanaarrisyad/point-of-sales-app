<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\SaldoPulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pembelian.index');
    }

    public function data()
    {
        $query = Pembelian::with('produk')->latest()->get();
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('produk', function ($produk) {
                if (!$produk->produk) {
                    return 'Pengisian saldo Pulsa ' . format_uang($produk->saldo_pulsa);
                }
                return $produk->produk->nama_produk;
            })
            ->editColumn('harga', function ($produk) {
                return format_uang($produk->harga_satuan);
            })
            ->editColumn('saldo_pulsa', function ($produk) {
                return format_uang($produk->saldo_pulsa);
            })
            ->addColumn('aksi', function ($produk) {
                $button = '
                <button class="btn btn-sm btn-success" onclick="detailData(`' . route('produk.detail', $produk->id) . '`,`' . $produk->nama_produk . '`)"><i class="fas fa-eye"></i></button>
                <button class="btn btn-sm btn-primary" onclick="editData(`' . route('produk.show', $produk->id) . '`)"><i class="fas fa-pencil-alt"></i></button>

                ';
                if (!$produk->produk) {

                    $button .=
                        '
                        <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('produk.destroy', $produk->id) . '`,`' . $produk->saldo_pulsa . '`)"><i class="fas fa-trash"></i></button>
                    ';
                } else {

                    $button .= '
                 <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('produk.destroy', $produk->id) . '`,`' . $produk->produk->nama_produk . '`)"><i class="fas fa-trash"></i></button>

                ';
                }

                return $button;
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

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Define validation rules based on the request type
            $rules = [
                'saldo_pulsa' => 'required|regex:/^[0-9.]+$/',
                'harga_pulsa' => 'required|regex:/^[0-9.]+$/',
                'vocer' => 'required',
                'harga' => 'required|regex:/^[0-9.]+$/',
                'jumlah_pembelian' => 'required',
            ];

            // Customize the validation rules based on the request type
            if ($request->type === 'pulsa') {
                unset($rules['vocer'], $rules['harga'], $rules['jumlah_pembelian']);
            } elseif ($request->type === 'vocer') {
                unset($rules['saldo_pulsa'], $rules['harga_pulsa']);
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa kembali inputan anda'], 422);
            }

            // Remove dots from values and ensure they are numeric
            $harga = str_replace('.', '', $request->harga);
            $harga_pulsa = str_replace('.', '', $request->harga_pulsa);
            $saldo_pulsa = str_replace('.', '', $request->saldo_pulsa);

            $data = [
                'produk_id' => $request->vocer ?? 0,
                'kode_pembelian' => 'P-' . rand(100000, 999999),
                'jumlah_pembelian' => $request->jumlah_pembelian ?? 1,
                'harga_satuan' => $request->type === 'vocer' ? $harga : $harga_pulsa,
                'total_harga_pembelian' => $request->type === 'vocer' ? $harga * $request->jumlah_pembelian : $harga_pulsa,
                'saldo_pulsa' => $request->type === 'pulsa' ? $saldo_pulsa : 0,
            ];

            $pembelian = Pembelian::create($data);

            if ($request->type === 'pulsa') {
                $saldo = SaldoPulsa::first();
                $saldo->pulsa_id = 0;
                $saldo->saldo_pulsa += $saldo_pulsa;
                $saldo->save();
            } else {
                $produk = Produk::findOrfail($pembelian->produk_id)->first();
                $produk->stok_saat_ini = $produk->stok_awal + $pembelian->jumlah_pembelian;
                $produk->stok_akhir = $produk->stok_awal + $pembelian->jumlah_pembelian;
                // $produk->stok_akhir = $produk->stok_awal + $pembelian->jumlah_pembelian - $keluar;
                $produk->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            return $th;
            DB::rollBack();
        }

        return response()->json(['message' => 'Data pembelian ' . $request->type . ' berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
