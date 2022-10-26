<?php

namespace App\Http\Controllers\Lotto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TicketController;
use App\Models\RollEvent;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RollEventStarter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * 
     * @return \Illuminate\Http\Responses
     */
    public function __invoke()
    {
        // check if there are valid tickets, if none redirect
        if (count(Ticket::where('owner', Auth::user()->name)
                        ->where('is_valid', true)
                        ->get()) == 0) {
            return redirect()->action(
                [TicketController::class, 'index']
            )->with('msg', 'You have no tickets.');
        }
        
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
            ->with('msg', 'Roll event created with ID: ' . $roll_event->id . '. Valid tickets are registered.');
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function registerValidTickets($roll_event_id)
    {
        DB::table('tickets')
            ->where('owner', Auth::user()->name)
            ->where('is_valid', true)
            ->update(['roll_event_id' => $roll_event_id]);
    }

    /**
     * 
     *
     * 
     * @return void
     */
    private function incrementRollEventsParticipated()
    {
        DB::table('users')
            ->where('id', Auth::id())
            ->increment('roll_events_participated');
    }
}
