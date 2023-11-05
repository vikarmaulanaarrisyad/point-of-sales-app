<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Pulsa;
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
            ->editColumn('kode_pembelian', function ($pembelian) {
                return '
                    <span class="badge badge-success">' . $pembelian->kode_pembelian . '</span>
                ';
            })
            ->addColumn('produk', function ($pembelian) {
                if (!$pembelian->produk) {
                    // return 'Nominal Pulsa ' . format_uang($pembelian->saldo_pulsa);
                    return 'Pulsa ';
                }
                // return $pembelian->produk->nama_produk;
                return 'Vocer';
            })
            ->editColumn('harga', function ($pembelian) {
                if ($pembelian->produk_id) {
                    return format_uang($pembelian->produk->harga_jual);
                }
                return format_uang($pembelian->pulsa->harga_jual);
            })
            ->editColumn('pulsa', function ($pembelian) {
                if ($pembelian->saldo_pulsa == 0) {
                    return $pembelian->produk->nama_produk;
                }
                return format_uang($pembelian->saldo_pulsa);
            })
            ->addColumn('aksi', function ($pembelian) {
                // <button class="btn btn-sm btn-success" onclick="detailData(`' . route('pembelian.detail', $pembelian->id) . '`,`' . $pembelian->nama_produk . '`)"><i class="fas fa-eye"></i></button>
                $button = '';
                if (!$pembelian->produk) {
                    $button .=
                        '
                        <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('pembelian.destroy', $pembelian->id) . '`,`' . 'Pulsa ' . format_uang($pembelian->saldo_pulsa) . '`)"><i class="fas fa-trash"></i></button>
                    ';
                } else {
                    $button .= '
                 <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('pembelian.destroy', $pembelian->id) . '`,`' . 'Vocer ' . $pembelian->produk->nama_produk . '`)"><i class="fas fa-trash"></i></button>

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
                // 'saldo_pulsa' => 'required|regex:/^[0-9.]+$/',
                // 'harga_pulsa' => 'required|regex:/^[0-9.]+$/',
                'vocer' => 'required',
                // 'harga' => 'required|regex:/^[0-9.]+$/',
                'jumlah_pembelian' => 'required',
            ];

            // Customize the validation rules based on the request type
            if ($request->type === 'pulsa') {
                $pulsa = Pulsa::findOrFail($request->pulsa); // return id pulsa
                unset($rules['vocer'], $rules['harga'], $rules['jumlah_pembelian']);
            } elseif ($request->type === 'vocer') {
                $produk = Produk::findOrFail($request->vocer); // return id vocer
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
                'pulsa_id' =>  $request->type === 'pulsa' ? $request->pulsa : 0,
                'kode_pembelian' => 'P-' . rand(100000, 999999),
                'jumlah_pembelian' => $request->jumlah_pembelian ?? 1,
                'harga_satuan' => $request->type === 'vocer' ? $produk->harga_beli : $pulsa->harga_beli,
                'total_harga_pembelian' => $request->type === 'vocer' ? $produk->harga_beli * $request->jumlah_pembelian : $pulsa->harga_beli,
                'saldo_pulsa' => $request->type === 'pulsa' ? $pulsa->nominal : 0,
            ];

            $pembelian = Pembelian::create($data);

            if ($request->type === 'pulsa') {
                $saldo = SaldoPulsa::where('pulsa_id', $pulsa->id)->first();
                if (!$saldo) {
                    // Create a new SaldoPulsa model if it doesn't exist
                    $saldo = new SaldoPulsa;
                    $saldo->pulsa_id = $pulsa->id;
                }
                $saldo->saldo_pulsa += $pulsa->nominal;
                $saldo->save();
            } else {
                $produk = Produk::findOrFail($pembelian->produk_id);

                // Update the Produk model with the new values
                $produk->stok_awal = 0;
                $produk->stok_saat_ini += $pembelian->jumlah_pembelian;
                $produk->stok_akhir += $pembelian->jumlah_pembelian;

                $produk->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 402);
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
        DB::beginTransaction();

        try {
            $saldoPulsa = SaldoPulsa::where('pulsa_id', $pembelian->pulsa_id)->first();
            $produk = Produk::where('id', $pembelian->produk_id)->first();
            if (!$saldoPulsa || $produk) {
                $produk->stok_saat_ini -= $pembelian->jumlah_pembelian; // Deduct the stock
                $produk->stok_akhir -= $pembelian->jumlah_pembelian; // Deduct the stock
                $produk->save(); // Save the updated stock
                $pembelian->delete(); // Delete the purchase record

                DB::commit();
                return response()->json(['message' => 'Data pembelian berhasil dihapus']);
            }

            $saldoPulsa->saldo_pulsa -= $pembelian->saldo_pulsa; // Deduct the pulsa
            $saldoPulsa->save();
            $pembelian->delete();

            DB::commit();
            return response()->json(['message' => 'Data pembelian berhasil dihapus']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menghapus data pembelian', 'error' => $th->getMessage()], 500);
        }
    }
}
