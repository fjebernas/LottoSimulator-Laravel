<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LottoType extends Model
{
    use HasFactory;

    protected $casts = [
        'digits_range' => 'array',
    ];
}
