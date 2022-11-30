@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/records/leaderboards.css">
@endsection

@section('customjs')
    <script src="/js/records/leaderboards.js" type="module"></script>
@endsection

@section('content')
    <h1>Highscore: </h1>

    <div class="table-responsive">
        <table class="center-text table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="col-md-1">Name</th>
                    <th scope="col" class="col-md-1">Tickets made</th>
                    <th scope="col" class="col-md-1">Roll events participated</th>
                    <th scope="col" class="col-md-1">Money</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @forelse ($users as $user)
                    <tr>
                        @if ($loop->first)
                            <td scope='row' class="">♛ {{ $user->name }}</td>
                        @else
                            <td scope='row' class="">{{ $user->name }}</td>
                        @endif
                        <td scope='row' class="">{{ $user->tickets->count() }}</td>
                        <td scope='row' class="">{{ $user->rollEvents->count() }}</td>
                        <td scope='row' class="text-success">₱{{ number_format($user->money)  }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No users</td>
                    <tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection