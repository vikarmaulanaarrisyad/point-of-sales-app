<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
