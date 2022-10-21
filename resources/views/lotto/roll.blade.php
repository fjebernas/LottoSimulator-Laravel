@extends('layouts.app')

@section('content')
    <h1 class='custom-h1'>It's RNG time.</h1>



    @if ($msg !== '')
    <div class='alert alert-success'>{{ $msg }}</div>
    @endif

    <div class="jumbotron bg-secondary text-white rounded">
        <h1 class="display-4">
                <!-- rolled digit shows here -->
                @if ($rolled_digit !== '')
                    {{ $rolled_digit }}
                @else
                    --
                @endif
        </h1>
        <p class="lead">Rolled number</p>
        <p class="lead">
            @if ($rolls_left > 0)
                <form action="/lotto/rolling" method="post">
                    @csrf
                    {{-- for passing the roll event id --}}
                    <input type="hidden" name="roll_event_id" value="{{ $roll_event_id }}">
                    <button class='btn btn-primary btn-lg' type='submit'>Roll!</button>
                </form>
            @else
                <form action="/lotto/results" method="post">
                    @csrf
                    <input type="hidden" name="roll_event_id" value="{{ $roll_event_id }}">
                    <button class='btn btn-info btn-lg' type='submit'>See results</button>
                </form>
            @endif
            
        </p>
    </div>



    <h1 class='custom-h1'>Your tickets:</h1>

    <table class="center-text table table-hover table-bordered text-center">
        <thead class="text-white bg-secondary">
            <tr>
                <th scope="col" class="col-md-1">Ticket ID</th>
                <th scope="col" class="col-md-2">Date created</th>
                @for ($i = 1; $i <= $combination_count; $i++)
                    <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
                @endfor
                <th scope="col" class="col-md-1">Roll event ID</th>
            </tr>
        </thead>
        <tbody>
            @if (count($tickets) > 0)
                @foreach ($tickets as $ticket)
                    <tr>
                        <th scope='row'>{{ $ticket->id }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        @foreach ($ticket->digits as $digit)
                            <td>{{ $digit }}</td>
                        @endforeach
                        <th scope='row'>{{ $ticket->roll_event_id }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ 2 + $combination_count }}">No tickets</td>
                <tr>
            @endif
            
        </tbody>
    </table>
@endsection
