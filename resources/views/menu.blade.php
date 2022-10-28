@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/menu.css">
@endsection

@section('customjs')
    <script src="/js/menu.js" type="module"></script>
@endsection

@section('content')
    <h1 class="pb-4 align-self-center">Welcome, {{ Auth::user()->name }}.</h1>
    <h3 class="pb-3 align-self-center">Select type of Lotto to play:</h3>

    <div class="d-flex flex-column row gx-0 gy-2 cards-container align-self-center">
        @forelse ($lotto_types as $lotto_type)
            <div class="card text-white animate__animated animate__fadeInLeft animate__faster" style="background: {{ $lotto_type->color_theme }};">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-1">{{ $lotto_type->name }}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <form action="/menu/set" method="GET" class="d-flex flex-column">
                        @csrf
                        <input type="hidden" name="lotto_type_id" value="{{ $lotto_type->id }}">
                        <button type="submit" class="btn btn-warning align-self-end px-4 animate__animated animate__swing">Play now</button>
                    </form>
                </div>
            </div>
        @empty
            <h2 class="text-center text-muted">No lotto types available.</h2>
        @endforelse
    </div>
@endsection
