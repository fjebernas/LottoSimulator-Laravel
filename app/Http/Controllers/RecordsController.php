<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    public function showLeaderboards(Request $request) {
        return view('records.leaderboards')
            ->with('users', User::orderBy('money', 'desc')->get());
    }
}
