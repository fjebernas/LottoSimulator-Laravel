<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RollEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotto_type',
        'rolls_left',
    ];
}
