@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/menu.css">
@endsection

@section('customjs')
    <script src="/js/menu.js" defer></script>
@endsection

@section('content')
    <h1 class="pb-4">Welcome, {{ Auth::user()->name }}.</h1>
    <h3 class="pb-3">Select type of Lotto to play:</h3>

    <div class="d-flex flex-column row gx-0 gy-2 w-50">
        <div class="card bg-success text-white">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fs-1">Lotto 6/42</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <form action="/menu/set" method="GET">
                    @csrf
                    <input type="hidden" name="lotto_mode" value="vanilla_lotto">
                    <button type="submit" class="btn btn-warning align-self-end">Play now</button>
                </form>
            </div>
        </div>

        <div class="card bg-danger text-white">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fs-1">Lotto 6/45</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <form action="/menu/set" method="GET">
                    @csrf
                    <input type="hidden" name="lotto_mode" value="mega_lotto">
                    <button type="submit" class="btn btn-warning align-self-end">Play now</button>
                </form>
            </div>
        </div>

        <div class="card bg-dark text-white">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fs-1">Ultra Lotto 6/58</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <form action="/menu/set" method="GET">
                    @csrf
                    <input type="hidden" name="lotto_mode" value="ultra_lotto">
                    <button type="submit" class="btn btn-warning align-self-end">Play now</button>
                </form>
            </div>
        </div>

        <div class="card bg-secondary text-white">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fs-1">Swertres Lotto 3/10</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <form action="/menu/set" method="GET">
                    @csrf
                    <input type="hidden" name="lotto_mode" value="swertres_lotto">
                    <button type="submit" class="btn btn-warning align-self-end">Play now</button>
                </form>
            </div>
        </div>
    </div>
@endsection
