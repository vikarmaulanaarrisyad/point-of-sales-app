<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pulsa()
    {
        return $this->belongsTo(Pulsa::class);
    }

    public function pulsa_saldo()
    {
        return $this->belongsTo(SaldoPulsa::class);
    }
}
