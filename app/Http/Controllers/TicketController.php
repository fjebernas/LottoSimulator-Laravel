<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        return view('ticket.index')
            ->with('tickets', Ticket::where('is_valid', true)->get())
            ->with('combination_count', Ticket::$combination_count);
    }

    public function create() {

        return view('ticket.create')
            ->with('combination_count', Ticket::$combination_count)
            ->with('digits_range', Ticket::$digits_range);
    }
    
    public function store(Request $request) {
        $ticket = new Ticket();

        $ticket->owner = Auth::user()->name;
        $ticket->digits = $request->digits;

        $ticket->save();

        return redirect('/tickets')
            ->with('msg', 'Ticket successfully created.');
    }
}
