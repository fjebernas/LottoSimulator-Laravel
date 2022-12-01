<?php

namespace App\Http\Controllers;

use App\Http\Requests\LottoTypeStoreRequest;
use Illuminate\Http\Request;
use App\Models\LottoType;

class LottoTypeController extends Controller
{
    public function create() 
    {
        return view('lottotype.create');
    }

    public function store(LottoTypeStoreRequest $request) 
    {
        LottoType::create($request->all());

        return redirect('/menu')
            ->with('notification', [
            'message' => 'Successfully created new Lotto Game',
            'type' => 'success'
        ]);
    }
}
