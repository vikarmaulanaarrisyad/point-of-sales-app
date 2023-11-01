<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pulsa extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
