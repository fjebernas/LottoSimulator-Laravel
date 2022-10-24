@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lotto/results.css">
@endsection

@section('customjs')
    <script src="/js/lotto/results.js" defer></script>
@endsection

@section('content')
    <h1 class='custom-h1'>Lotto results: </h1>

    <div class='rolls-container d-flex flex-row container flex-wrap'>
        @foreach ($rolls as $roll)
            <div class='text-center card text-white bg-gradient mb-3' style='background: #553491; max-width: 10rem; margin-right: 10px;'>
                <div class='card-header'>Rolled digit</div>
                <div class='card-body'>
                    <h1 class='card-title py-0'>
                        <code class="text-white fs-1">
                            {{ $roll }}
                        </code>
                    </h1>
                </div>
            </div>
        @endforeach
    </div>

    @foreach ($tickets as $ticket)
        @if ($ticket->matched_digits == 6)
            <div class='alert alert-success'>Congratulations! You won 100,000,000 pesos!</div>
        @elseif ($ticket->matched_digits == 5)
            <div class='alert alert-success'>Congratulations! You won 100,000 pesos!</div>
        @elseif ($ticket->matched_digits == 4)
            <div class='alert alert-success'>Congratulations! You won 1000 pesos!</div>
        @elseif ($ticket->matched_digits == 3)
            <div class='alert alert-success'>Congratulations! You won 500 pesos!</div>
        @elseif ($ticket->matched_digits == 2)
            <div class='alert alert-success'>Congratulations! You won 100 pesos!</div>
        @endif
    @endforeach

    <h1 class='custom-h1'>Your tickets:</h1>

    <div class="table-responsive">
        <table class="center-text table table-hover table-bordered text-center">
            <thead class="text-white bg-secondary">
                <tr>
                    <th scope="col" class="col-md-1">Ticket ID</th>
                    @for ($i = 1; $i <= $combination_count; $i++)
                        <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
                    @endfor
                    <th scope="col" class="col-md-1">Matched digits</th>
                </tr>
            </thead>
            <tbody>
                @if (count($tickets) > 0)
                    @foreach ($tickets as $ticket)
                        <tr>
                            <th scope='row'>{{ $ticket->id }}</td>
                            @foreach ($ticket->digits as $digit)
                                @if (in_array($digit, $rolls))
                                    <td class="bg-success fw-bold text-warning">{{ $digit }}</td>
                                @else
                                    <td>{{ $digit }}</td>
                                @endif
                            @endforeach
                            <th scope='row'>{{ $ticket->matched_digits }}</td>
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

    <div class="buttons">
        <a href="/" class='btn btn-warning'>Back to home</a>
    </div>
@endsection