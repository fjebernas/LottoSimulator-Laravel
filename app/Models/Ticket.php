<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $casts = [
        'digits' => 'array'
    ];
    
    public static $combination_count = '3';
    public static $digits_range = array('min' => 0, 'max' => 9);
}
