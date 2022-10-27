<?php

namespace App\Http\Controllers\Lotto;

use App\Http\Controllers\Controller;
use App\Models\Roll;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $roll_event_id = $request->roll_event_id;

        $this->setTicketsMatchedDigits($roll_event_id);
        $this->addMoney($roll_event_id);
        $this->invalidateTickets($roll_event_id);
        $this->closeRollEvent($roll_event_id);

        return view('lotto.results')
            ->with('rolls', Roll::where('roll_event_id', $roll_event_id)
                                ->pluck('rolled_digit')
                                ->toArray())
            ->with('tickets', Ticket::where('owner', Auth::user()->name)
                                    ->where('lotto_type', session('lotto_type'))
                                    ->where('roll_event_id', $roll_event_id)
                                    ->get());
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function setTicketsMatchedDigits($roll_event_id)
    {
        $tickets = Ticket::where('roll_event_id', $roll_event_id)
                        ->where('owner', Auth::user()->name)
                        ->get();
        foreach ($tickets as $ticket) {
            $this->setMatchedDigits($roll_event_id, $ticket->id);
        }
    }

    /**
     * 
     *
     * @param int $roll_event_id @param int $ticket_id
     * @return void
     */
    private function setMatchedDigits($roll_event_id, $ticket_id)
    {
        DB::table('tickets')
            ->where('id', $ticket_id)
            ->update(['matched_digits' => $this->getMatchedDigits($roll_event_id, $ticket_id)]);
    }

    /**
     * 
     *
     * @param int $roll_event_id @param int $ticket_id
     * @return int $counter
     */
    private function getMatchedDigits($roll_event_id, $ticket_id)
    {
        $counter = 0;
        $rolled_digits = Roll::where('roll_event_id', $roll_event_id)
                            ->pluck('rolled_digit');
        foreach ($rolled_digits as $rolled_digit) {
            if (in_array($rolled_digit, Ticket::where('id', $ticket_id)
                                            ->value('digits'))) {
                $counter += 1;
            }
        }
        return $counter;
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function addMoney($roll_event_id)
    {
        DB::table('users')
            ->where('id', Auth::id())
            ->increment('money', $this->calculateMoneyToAdd($roll_event_id));
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return int $moneyToAdd
     */
    private function calculateMoneyToAdd($roll_event_id)
    {
        $tickets = Ticket::where('roll_event_id', $roll_event_id)
                        ->where('owner', Auth::user()->name)
                        ->get();
        $moneyToAdd = 0;
        foreach ($tickets as $ticket) {
            if ($ticket->matched_digits == 6) {
                $moneyToAdd += 100000000;
            } else if ($ticket->matched_digits == 5) {
                $moneyToAdd += 100000;
            } else if ($ticket->matched_digits == 4) {
                $moneyToAdd += 1000;
            } else if ($ticket->matched_digits == 3) {
                $moneyToAdd += 500;
            } else if ($ticket->matched_digits == 2) {
                $moneyToAdd += 100;
            }
        }
        return $moneyToAdd;
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function invalidateTickets($roll_event_id)
    {
        DB::table('tickets')
            ->where('owner', Auth::user()->name)
            ->where('roll_event_id', $roll_event_id)
            ->update(['is_valid' => false]);
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function closeRollEvent($roll_event_id)
    {
        $this->recordMoneyAwarded($roll_event_id);
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->update(['is_finished' => true]);
    }

    /**
     * 
     *
     * @param int $roll_event_id
     * @return void
     */
    private function recordMoneyAwarded($roll_event_id)
    {
        DB::table('roll_events')
            ->where('id', $roll_event_id)
            ->increment('money_awarded', $this->calculateMoneyToAdd($roll_event_id));
    }
}
