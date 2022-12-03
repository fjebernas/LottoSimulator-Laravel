<?php

namespace App\Services;

use App\Models\LottoType;
use Illuminate\Support\Facades\Session;

class LottoTypeService 
{
    public function setSessionData($lotto_type)
    {
        Session::put('lotto_type', $lotto_type->name);
        Session::put('combination_count', $lotto_type->combination_count);
        Session::put('digits_range', $lotto_type->digits_range);
    }
}