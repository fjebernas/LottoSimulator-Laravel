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

    /** list all tickets
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        return view('ticket.index')
            ->with('tickets', Ticket::where('owner', Auth::user()->name)
                                    ->where('is_valid', true)
                                    ->get());
    }

    /** show the form for creating a ticket
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        return view('ticket.create');
    }
    
    /** store the new ticket in tickets table
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $ticket = new Ticket();

        $ticket->owner = Auth::user()->name;
        $ticket->digits = $request->digits;
        $ticket->save();

        $this->incrementTicketsCreated();

        return redirect('/tickets')
            ->with('msg', 'Ticket successfully created.');
    }

    
    /** increment tickets_created for a user in users table
     *
     *
     * 
     * @return void
     */
    private function incrementTicketsCreated() {
        DB::table('users')
            ->where('id', Auth::id())
            ->increment('tickets_created');
    }
}
