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

        if ($request->lotto_mode == 'Lotto 6/42') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 42));
        } else if ($request->lotto_mode == 'Swertres Lotto 3/10') {
            Session::put('combination_count', '3');
            Session::put('digits_range', array('min' => 0, 'max' => 9));
        } else if ($request->lotto_mode == 'Mega Lotto 6/45') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 45));
        } else if ($request->lotto_mode == 'Ultra Lotto 6/58') {
            Session::put('combination_count', '6');
            Session::put('digits_range', array('min' => 1, 'max' => 58));
        }
        Session::put('lotto_type', $request->lotto_mode);

        return redirect('/tickets');
    }
}
