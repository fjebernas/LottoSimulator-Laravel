@extends('layouts.app')

@section('content')
<h1 class='custom-h1'>Your tickets:</h1>

@if (session('msg') !== null)
    <div class='alert alert-success'>{{ session('msg') }}</div>
@endif

<table class="center-text table table-hover table-bordered text-center">
    <thead class="text-white bg-secondary">
        <tr>
        <th scope="col" class="col-md-1">Ticket ID</th>
        <th scope="col" class="col-md-2">Date created</th>
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
                    <td>{{ $ticket->created_at }}</td>
                    @foreach ($ticket->digits as $digit)
                        <td>{{ $digit }}</td>
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

<div class="buttons">
    <a href='/tickets/create' class='btn btn-primary'>Add ticket</a>
    @if (count($tickets) > 0)
    <a id="btn-proceed" class='btn btn-warning'>Proceed</a>
    @else
    <a href="#" class='btn btn-warning disabled'>Proceed</a>
    @endif
</div>

@endsection
