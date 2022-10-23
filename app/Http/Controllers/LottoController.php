<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use App\Models\RollEvent;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class LottoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start() {
        // create new roll event, set how many rolls and save to database
        $roll_event = new RollEvent();
        $roll_event->rolls_left = Ticket::$combination_count;
        $roll_event->save();

        $this->registerValidTickets($roll_event->id);

        return view('lotto.roll')
            ->with('tickets', Ticket::where('is_valid', true)->get())
            ->with('combination_count', Ticket::$combination_count)
            ->with('roll_event_id', $roll_event->id)
            ->with('msg', 'Roll event created with ID: ' . $roll_event->id . '. Valid tickets are registered.');
    }

    /*
    * ajax
    */
    public function store(Request $request) {
        // get the current roll event id through POST
        $roll_event_id = $request->roll_event_id;

        $unique_random_digit = $this->getUniqueRandomDigit($roll_event_id);
        $this->storeRoll($unique_random_digit, $roll_event_id);

        $this->decrementRollsLeft($roll_event_id);

        return Response::json(array(
            'rolls_left' =>  RollEvent::where('id', $roll_event_id)->value('rolls_left'),
            'rolled_digit' => $unique_random_digit,
            'rolls' => Roll::where('roll_event_id', $roll_event_id)->pluck('rolled_digit')->toArray(),
            'msg' => 'RNG success. Rolled digit: ' . $unique_random_digit
        ));
    }

    public function showResults(Request $request) {
        $roll_event_id = $request->roll_event_id;

        $this->setTicketsMatchedDigits($roll_event_id);
        $this->invalidateTickets($roll_event_id);
        $this->closeRollEvent($roll_event_id);

        return view('lotto.results')
            ->with('rolls', Roll::where('roll_event_id', $roll_event_id)
                                ->pluck('rolled_digit')
                                ->toArray())
            ->with('tickets', Ticket::where('roll_event_id', $roll_event_id)->get())
            ->with('combination_count', Ticket::$combination_count);
    }

    /*
    *
    *
    *
    */

    private function registerValidTickets($roll_event_id) {
        DB::table('tickets')
            ->where('is_valid', true)
            ->update(['roll_event_id' => $roll_event_id]);
    }

    private function getUniqueRandomDigit($roll_event_id) {
        $random_digit = null;
        do {
            $random_digit = rand(Ticket::$digits_range['min'], Ticket::$digits_range['max']);
        } while (Roll::where('roll_event_id', $roll_event_id)
                    ->where('rolled_digit', $random_digit)
                    ->exists());

        return $random_digit;
    }

    private function storeRoll($digit, $roll_event_id) {
        $roll = new Roll();
        $roll->rolled_digit = $digit;
        $roll->roll_event_id = $roll_event_id;
        $roll->save();
    }

    private function decrementRollsLeft($roll_event_id) {
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->decrement('rolls_left');
    }

    private function invalidateTickets($roll_event_id) {
        DB::table('tickets')
            ->where('roll_event_id', $roll_event_id)
            ->update(['is_valid' => false]);
    }

    private function closeRollEvent($roll_event_id) {
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->update(['is_finished' => true]);
    }

    private function setTicketsMatchedDigits($roll_event_id) {
        $tickets = Ticket::where('roll_event_id', $roll_event_id)->get();
        foreach ($tickets as $ticket) {
            $this->setMatchedDigits($roll_event_id, $ticket->id);
        }
    }

    private function setMatchedDigits($roll_event_id, $ticket_id) {
        DB::table('tickets')
            ->where('id', $ticket_id)
            ->update(['matched_digits' => $this->getMatchedDigits($roll_event_id, $ticket_id)]);
    }

    private function getMatchedDigits($roll_event_id, $ticket_id) {
        $counter = 0;
        $rolled_digits = Roll::where('roll_event_id', $roll_event_id)
                            ->pluck('rolled_digit');
        foreach ($rolled_digits as $rolled_digit) {
            if (in_array($rolled_digit, Ticket::where('id', $ticket_id)
                                            ->value('digits'))) {
                $counter = $counter + 1;
            }
        }

        return $counter;
    }
}
