<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LottoType;
use App\Services\LottoTypeService;

class MenuController extends Controller
{
    public function menu() 
    {
        return view('menu')
            ->with('lotto_types', LottoType::all());
    }

    public function setSessionDataAndRedirect(Request $request, LottoTypeService $lottoTypeService) 
    {
        $lotto_type = LottoType::where('id', $request->lotto_type_id)->first();
        
        $lottoTypeService->setSessionData($lotto_type);

        return redirect('/tickets');
    }
}
