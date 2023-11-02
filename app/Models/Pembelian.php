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
}
