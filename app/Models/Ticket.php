<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $casts = [
        'digits' => 'array',
    ];

    protected $fillable = [
        'lotto_type',
        'digits',
        'matched_digits',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}
