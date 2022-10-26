<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function menu() {
        return view('menu');
    }

    public function setSessionDataAndRedirect(Request $request) {

        if ($request->lotto_mode == 'vanilla_lotto') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 42));
        } else if ($request->lotto_mode == 'mega_lotto') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 45));
        } else if ($request->lotto_mode == 'ultra_lotto') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 58));
        } else if ($request->lotto_mode == 'swertres_lotto') {
            Session::put('combination_count', '3');
            Session::put('digits_range', array('min' => 0, 'max' => 9));
        }
        Session::put('lotto_type', $request->lotto_mode);

        return redirect('/tickets');
    }
}
