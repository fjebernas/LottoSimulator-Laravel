<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index() {

        return view('ticket.index')
            ->with('tickets', Ticket::where('is_valid','=',true)->get())
            ->with('combination_count', Ticket::$combination_count);
    }

    public function create() {

        return view('ticket.create')
            ->with('digits_range', Ticket::$digits_range);
    }

    public function store() {
        $ticket = new Ticket();

        $ticket->digits = request('digits');

        $ticket->save();

        return redirect('/tickets')
            ->with('msg', 'Ticket successfully created.');
    }
}
