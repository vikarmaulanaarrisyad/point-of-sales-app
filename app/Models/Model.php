<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquents;

class Model extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
