<?php

namespace App\Http\Controllers\Lotto;

use App\Http\Controllers\Controller;
use App\Models\RollEvent;
use App\Models\Roll;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RollController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // get the current roll event id through POST
        $roll_event_id = $request->roll_event_id;

        $unique_random_digit = $this->getUniqueRandomDigit($roll_event_id);
        $this->storeRoll($unique_random_digit, $roll_event_id);

        $this->decrementRollsLeft($roll_event_id);

        return Response::json(array(
            'rolls_left' =>  RollEvent::where('id', $roll_event_id)
                                    ->value('rolls_left'),
            'rolled_digit' => $unique_random_digit,
            'msg' => 'RNG success. Rolled digit: ' . $unique_random_digit
        ));
    }

    /**
     * 
     *
     * @param  int $roll_event_id
     * @return int $random_digit
     */
    private function getUniqueRandomDigit($roll_event_id)
    {
        $random_digit = null;
        do {
            $random_digit = rand(Ticket::$digits_range['min'], Ticket::$digits_range['max']);
        } while (Roll::where('roll_event_id', $roll_event_id)
                    ->where('rolled_digit', $random_digit)
                    ->exists());

        return $random_digit;
    }

    /**
     * 
     *
     * @param  int $digit @param  int $roll_event_id
     * @return void
     */
    private function storeRoll($digit, $roll_event_id)
    {
        $roll = new Roll();
        $roll->rolled_digit = $digit;
        $roll->roll_event_id = $roll_event_id;
        $roll->save();
    }

    /**
     * 
     *
     * @param  int $roll_event_id
     * @return void
     */
    private function decrementRollsLeft($roll_event_id)
    {
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->decrement('rolls_left');
    }
}
