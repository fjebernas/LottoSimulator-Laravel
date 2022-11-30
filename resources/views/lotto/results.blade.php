@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lotto/results.css">
@endsection

@section('customjs')
    <script src="/js/lotto/results.js" type="module"></script>
@endsection

@section('content')
    <h1 class="fw-bold pb-0 mb-0 text-center font-weight-bold">{{ session('lotto_type') }}</h1>
    <h1 class='custom-h1'>Lotto results:</h1>

    <div class='rolls-container d-flex flex-row container flex-wrap  animate__animated animate__bounceInLeft'>
        @forelse ($rolls as $roll)
            <div class='text-center card text-white bg-primary bg-gradient mb-3' style='max-width: 10rem; margin-right: 10px;'>
                <div class='card-header'>Rolled digit</div>
                <div class='card-body'>
                    <h1 class='card-title py-0'>
                        <span class="text-white fs-1">
                            {{ $roll }}
                        </span>
                    </h1>
                </div>
            </div>
        @empty
            <h2 class="text-muted text-center py-2">No rolls found.</h2>
        @endforelse
        
    </div>

    @foreach ($tickets as $ticket)
        @if ($ticket->matched_digits >= 6)
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
        <table class="center-text table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="col-md-1">Ticket ID</th>
                    @for ($i = 1; $i <= session('combination_count'); $i++)
                        <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
                    @endfor
                    <th scope="col" class="col-md-1">Matched digits</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @forelse ($tickets as $ticket)
                    <tr>
                        <th scope='row' class="text-primary" style="background: #aaa !important">{{ $ticket->id }}</td>
                        @foreach ($ticket->digits as $digit)
                            @if (in_array($digit, $rolls))
                                <td class="bg-success fw-bold text-white">{{ $digit }}</td>
                            @else
                                <td>{{ $digit }}</td>
                            @endif
                        @endforeach
                        <th scope='row' class="bg-dark text-white">{{ $ticket->matched_digits }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 2 + session('combination_count') }}">No tickets</td>
                    <tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="buttons">
        <a href="/" class='btn btn-warning d-flex align-items-center text-black'>
            <box-icon name='home' color='white'></box-icon>
            &nbsp;Back to home
        </a>
    </div>
@endsection