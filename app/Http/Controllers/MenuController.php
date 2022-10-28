<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LottoType;

class MenuController extends Controller
{
    public function menu() {
        return view('menu')
            ->with('lotto_types', LottoType::all());
    }

    public function setSessionDataAndRedirect(Request $request) {

        $lotto_type = LottoType::where('id', $request->lotto_type_id)->first();
        
        Session::put('lotto_type', $lotto_type->name);
        Session::put('combination_count', $lotto_type->combination_count);
        Session::put('digits_range', $lotto_type->digits_range);

        return redirect('/tickets');
    }
}
