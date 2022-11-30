<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LottoType;

class TicketController extends Controller
{
    /** list all tickets
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('ticket.index')
                ->with('tickets', Auth::user()->tickets
                                            ->where('lotto_type', session('lotto_type'))
                                            ->where('is_valid', true));
    }

    /** show the form for creating a ticket
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('ticket.create');
    }
    
    /** store the new ticket in tickets table
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        Ticket::create([
            'lotto_type' => session('lotto_type'),
            'digits' => $request->digits,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/tickets')
            ->with('notification', [
                'message' => 'Ticket successfully created.',
                'type' => 'success'
            ]
        );
    }
}
