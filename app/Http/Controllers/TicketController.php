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
    public function index(Request $request) {

        return view('ticket.index')
                ->with('tickets', Ticket::where('owner', Auth::user()->name)
                    ->where('lotto_type', session('lotto_type'))
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
    public function store(Request $request) 
    {
        Ticket::create([
            'lotto_type' => session('lotto_type'),
            'digits' => $request->digits,
            'owner' => Auth::user()->name,
        ]);

        $this->incrementTicketsCreated();

        return redirect('/tickets')
            ->with('notification', [
                'message' => 'Ticket successfully created.',
                'type' => 'success'
            ]
        );
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
