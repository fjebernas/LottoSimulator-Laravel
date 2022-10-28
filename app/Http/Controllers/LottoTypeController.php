<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LottoType;

class LottoTypeController extends Controller
{
    public function create(Request $request) {
        return view('lottotype.create');
    }

    public function store(Request $request) {
        $lotto_type = new LottoType();
        $lotto_type->name = $request->name;
        $lotto_type->combination_count = $request->combination_count;
        $lotto_type->digits_range = [
                                        'min' => $request->digits_range[0],
                                        'max' => $request->digits_range[1]
                                    ];
        $lotto_type->color_theme = $request->color_theme;
        $lotto_type->save();

        return redirect('/lottotype/create')->with('notification', [
                'message' => 'Successfully created new Lotto Game',
                'type' => 'success'
            ]
        );
    }
}
