@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/ticket/index.css">
@endsection

@section('customjs')
    <script src="/js/ticket/index.js" type="module"></script>
@endsection

@section('content')
<h1 class="fw-bold pb-0 mb-0 text-center font-weight-bold">{{ session('lotto_type') }}</h1>
<h1 class='custom-h1'>Your tickets:</h1>

<div class="table-responsive">
    <table class="center-text table table-hover table-bordered text-center">
        <thead class="text-white bg-secondary">
            <tr>
            <th scope="col" class="col-md-1">Ticket ID</th>
            <th scope="col" class="col-md-2">Date created</th>
            @for ($i = 1; $i <= session('combination_count'); $i++)
                <th scope='col' class='col-md-1'>Digit #{{ $i }}</th>
            @endfor
            </tr>
        </thead>
        <tbody>
            @if (count($tickets) > 0)
                @foreach ($tickets as $ticket)
                    <tr>
                        <th scope='row' class="">{{ $ticket->id }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        @foreach ($ticket->digits as $digit)
                            <td>{{ $digit }}</td>
                        @endforeach
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ 2 + session('combination_count') }}">No tickets</td>
                <tr>
            @endif
            
        </tbody>
    </table>
</div>

<div class="buttons">
    <a href='/menu' class='btn btn-danger d-flex align-items-center'>
        <box-icon name='arrow-back' color='white'></box-icon>
        Go back
    </a>
    <a href='/tickets/create' class='btn btn-primary d-flex align-items-center'>
        <box-icon name='plus' color='white'></box-icon>
        Add ticket
    </a>
    @if (count($tickets) > 0)
    <a id="btn-proceed" class='btn btn-warning d-flex align-items-center'>
        Proceed
        <box-icon name='right-arrow-alt' color='black'></box-icon>
    </a>
    @else
    <a href="#" class='btn btn-warning disabled d-flex align-items-center'>
        Proceed
        <box-icon name='right-arrow-alt' color='black'></box-icon>
    </a>
    @endif
</div>

@endsection
