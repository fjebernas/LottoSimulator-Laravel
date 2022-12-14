@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lotto/roll.css">
@endsection

@section('customjs')
    <script src="/js/lotto/roll.js" type="module"></script>
@endsection

@section('content')
    <h1 class="fw-bold pb-0 mb-0 text-center font-weight-bold">{{ session('lotto_type') }}</h1>
    <h1 class='custom-h1 pb-0'>It's RNG time.</h1>

    <div class="jumbotron bg-secondary bg-gradient text-white rounded">
        <h6 id="rolls-left-container" class="text-center py-0 my-0">Rolls left: {{ $rolls_left }}</h6>
        <h1 class="display-4 py-0 my-0">
            <span id='rolled-digit-container' class="text-white">
                <!-- rolled digit shows here -->
                --
            </span>
        </h1>
        <p class="lead">Rolled number</p>
        <p class="lead">
            {{-- form to be used only after rolling is done --}}
            <form action='/lotto/results' method='post'>
                @csrf
                {{-- button used by ajax and to be replaced by button that uses the form tag --}}
                <div id="btn-roll-container">
                    <input id="roll_event_id" type="hidden" name="roll_event_id" value="{{ $roll_event_id }}">
                    <button id='btn-roll' class='btn bg-info text-white btn-lg' type='button'>Roll!</button>
                </div>
            </form>
            
        </p>
    </div>



    <h1 class='custom-h1'>Your tickets:</h1>

    <div class="table-responsive">
        <table class="center-text table table-bordered text-center table-light">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="col-md-1">Ticket ID</th>
                    @for ($i = 1; $i <= session('combination_count'); $i++)
                        <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody class="table-light">
                @forelse ($tickets as $ticket)
                    <tr>
                        <th scope='row' class="text-primary" style="background: #aaa !important">{{ $ticket->id }}</td>
                        @foreach ($ticket->digits as $digit)
                            <td class="{{ $digit }}">{{ $digit }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 2 + session('combination_count') }}">No tickets</td>
                    <tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- notification - to be used in js --}}
    <div id='notification-msg' class='d-none' data-msg='{{ $msg }}'></div>
    
@endsection
