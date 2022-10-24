@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/leaderboards.css">
@endsection

@section('customjs')
    <script src="/js/leaderboards.js" defer></script>
@endsection

@section('content')
    <h1>Highscore: </h1>

    <div class="table-responsive">
        <table class="center-text table table-hover table-bordered text-center">
            <thead class="text-white bg-secondary">
                <tr>
                    <th scope="col" class="col-md-1">User ID</th>
                    <th scope="col" class="col-md-1">Name</th>
                    <th scope="col" class="col-md-1">Tickets made</th>
                    <th scope="col" class="col-md-1">Roll events participated</th>
                    <th scope="col" class="col-md-1">Robux</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <tr>
                            <th scope='row' class="">{{ $user->id }}</td>
                            <td scope='row' class="">{{ $user->name }}</td>
                            <td scope='row' class=""></td>
                            <td scope='row' class=""></td>
                            <td scope='row' class=""></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ 2 + $combination_count }}">No users</td>
                    <tr>
                @endif
                
            </tbody>
        </table>
    </div>
@endsection
