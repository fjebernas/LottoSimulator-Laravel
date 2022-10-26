@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lotto/roll.css">
@endsection

@section('customjs')
    <script src="/js/lotto/roll.js" type="module" defer></script>
@endsection

@section('content')
    <h1 class='custom-h1 pb-0'>It's RNG time.</h1>

    <div class="jumbotron bg-gradient text-white rounded" style="background: #553491;">
        <h6 id="rolls-left-container" class="text-center py-0 my-0">Rolls left: {{ $rolls_left }}</h6>
        <h1 class="display-4 py-0 my-0">
            <code id='rolled-digit-container' class="text-white">
                <!-- rolled digit shows here -->
                --
            </code>
        </h1>
        <p class="lead">Rolled number</p>
        <p class="lead">
            {{-- form to be used only after rolling is done --}}
            <form action='/lotto/results' method='post'>
                @csrf
                {{-- button used by ajax and to be replace by button that uses the form tag --}}
                <div id="btn-roll-container">
                    <input id="roll_event_id" type="hidden" name="roll_event_id" value="{{ $roll_event_id }}">
                    <button id='btn-roll' class='btn bg-primary text-white btn-lg' type='button'>Roll!</button>
                </div>
            </form>
            
        </p>
    </div>



    <h1 class='custom-h1'>Your tickets:</h1>

    <div class="table-responsive">
        <table class="center-text table table-hover table-bordered text-center">
            <thead class="text-white bg-secondary">
                <tr>
                    <th scope="col" class="col-md-1">Ticket ID</th>
                    @for ($i = 1; $i <= $combination_count; $i++)
                        <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @if (count($tickets) > 0)
                    @foreach ($tickets as $ticket)
                        <tr>
                            <th scope='row'>{{ $ticket->id }}</td>
                            @foreach ($ticket->digits as $digit)
                                @isset($rolls)
                                    @if (in_array($digit, $rolls))
                                        <td class="bg-success fw-bold text-warning">{{ $digit }}</td>
                                    @else
                                        <td>{{ $digit }}</td>
                                    @endif
                                @else
                                    <td class={{ $digit }}>{{ $digit }}</td>
                                @endisset
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ 2 + $combination_count }}">No tickets</td>
                    <tr>
                @endif
                
            </tbody>
        </table>
    </div>

    {{-- notification - to be used in js --}}
    <div id='notification-msg' class='d-none' data-msg='{{ $msg }}'></div>
    
@endsection
