<?php

namespace App\Http\Controllers\Lotto;

use App\Http\Controllers\Controller;
use App\Models\RollEvent;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RollEventStarter extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        // create new roll event, set how many rolls and save to database
        $roll_event = new RollEvent();
        $roll_event->rolls_left = Ticket::$combination_count;
        $roll_event->save();

        $this->registerValidTickets($roll_event->id);
        $this->incrementRollEventsParticipated();

        return view('lotto.roll')
            ->with('roll_event_id', $roll_event->id)
            ->with('rolls_left', RollEvent::where('id', $roll_event->id)->value('rolls_left'))
            ->with('tickets', Ticket::where('owner', Auth::user()->name)
                                    ->where('is_valid', true)
                                    ->get())
            ->with('combination_count', Ticket::$combination_count)
            ->with('msg', 'Roll event created with ID: ' . $roll_event->id . '. Valid tickets are registered.');
    }

    private function registerValidTickets($roll_event_id) {
        DB::table('tickets')
            ->where('owner', Auth::user()->name)
            ->where('is_valid', true)
            ->update(['roll_event_id' => $roll_event_id]);
    }

    private function incrementRollEventsParticipated() {
        DB::table('users')
            ->where('id', Auth::id())
            ->increment('roll_events_participated');
    }
}
