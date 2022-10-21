<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use App\Models\RollEvent;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class LottoController extends Controller
{
    public function start() {
        // create new roll event, set how many rolls and save to database
        $roll_event = new RollEvent();
        $roll_event->rolls_left = Ticket::$combination_count;
        $roll_event->save();

        $this->registerValidTickets($roll_event->id);

        return view('lotto.roll')
            ->with('tickets', Ticket::where('is_valid','=',true)->get())
            ->with('combination_count', Ticket::$combination_count)
            ->with('roll_event_id', $roll_event->id)
            ->with('rolled_digit', '')
            ->with('rolls_left', $roll_event->rolls_left)
            ->with('msg', 'Roll event created with ID: ' . $roll_event->id . '. Valid tickets are registered.');
    }

    public function registerValidTickets($roll_event_id) {
        DB::table('tickets')
            ->where('is_valid', true)
            ->update(['roll_event_id' => $roll_event_id]);
    }

    public function roll() {
        // get the current roll event id through POST
        $roll_event_id = request('roll_event_id');

        $unique_random_digit = $this->getUniqueRandomDigit($roll_event_id);
        $this->storeRoll($unique_random_digit, $roll_event_id);

        $this->decrementRollsLeft($roll_event_id);
        
        return view('lotto.roll')
            ->with('tickets', Ticket::where('roll_event_id', '=', $roll_event_id)->get())
            ->with('combination_count', Ticket::$combination_count)
            ->with('roll_event_id', $roll_event_id)
            ->with('rolled_digit', $unique_random_digit)
            ->with('rolls_left', RollEvent::where('id', $roll_event_id)->value('rolls_left'))
            ->with('msg', 'RNG success. Rolled digit: ' . $unique_random_digit);
    }

    public function getUniqueRandomDigit($roll_event_id) {
        $random_digit = null;
        do {
            $random_digit = rand(Ticket::$digits_range['min'], Ticket::$digits_range['max']);
        } while (DB::table('rolls')
                    ->where('roll_event_id', $roll_event_id)
                    ->where('rolled_digit', $random_digit)
                    ->exists());

        return $random_digit;
    }

    public function storeRoll($digit, $roll_event_id) {
        $roll = new Roll();
        $roll->rolled_digit = $digit;
        $roll->roll_event_id = $roll_event_id;
        $roll->save();
    }

    public function decrementRollsLeft($roll_event_id) {
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->decrement('rolls_left');
    }

    public function showResults() {
        $roll_event_id = request('roll_event_id');

        $rolls = Roll::where('roll_event_id', $roll_event_id)->get();

        $this->invalidateTickets($roll_event_id);
        $this->closeRollEvent($roll_event_id);

        return view('lotto.results')
            ->with('tickets', Ticket::where('roll_event_id', '=', $roll_event_id)->get())
            ->with('combination_count', Ticket::$combination_count)
            ->with('rolls', $rolls);
    }

    public function invalidateTickets($roll_event_id) {
        DB::table('tickets')
        ->where('roll_event_id', $roll_event_id)
        ->update(['is_valid' => false]);
    }

    public function closeRollEvent($roll_event_id) {
        DB::table('roll_events')
        ->where('id', $roll_event_id)
        ->update(['is_finished' => true]);
    }
}