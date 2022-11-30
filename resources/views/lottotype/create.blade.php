@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lottotype/create.css">
@endsection

@section('customjs')
    <script src="/js/lottotype/create.js" type="module"></script>
@endsection

@section('content')
    <h1 class="fw-bold align-self-center">Create a custom Lotto game:</h1>

    <div class="form-container d-flex flex-column align-self-center">
        <form action="/lottotype" method="POST">
            @csrf
            <div class="form-group pb-3">
                <label for="lotto-name">Name of your custom Lotto game:</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="lotto-name" placeholder="ex: Custom Lotto 5/20">
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        
            <div class="form-group pb-3">
                <label for="lotto-combination-count">Combination count:</label>
                <input name="combination_count" type="number" class="form-control @error('combination_count') is-invalid @enderror" id="lotto-combination-count" placeholder="ex: 5">
            </div>
            @error('combination_count')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        
            <h6 class="pb-2 m-0">Digits range:</h6>
            <fieldset class="row gx-2">
                <div class="col input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">min</span>
                    <input name="digits_range[]" type="number" min="0" class="form-control text-center @error('digits_range.*') is-invalid @enderror" placeholder="ex: 1" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="col input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">max</span>
                    <input name="digits_range[]" type="number" min="0" class="form-control text-center @error('digits_range.*') is-invalid @enderror" placeholder="ex: 20" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </fieldset>
            @error('digits_range.*')
                <div class="alert alert-danger">{{ str_replace (array('_', '.'), ' ' , $message) }}</div>
            @enderror
        
            <div class="form-group pb-3 m-0">
                <label for="lotto-color-theme">Color theme:</label>
                <input name="color_theme" type="text" class="form-control @error('color_theme') is-invalid @enderror" id="lotto-color-theme" placeholder="ex: blue">
            </div>
            @error('color_theme')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="buttons py-3">
                <a href="/" class="btn btn-danger d-flex align-items-center">
                    <box-icon name='arrow-back' color='white'></box-icon>
                    Go back
                </a>
                <button id="btn-create" type="submit" class="btn btn-success d-flex align-items-center">
                    Create
                    <box-icon name='right-arrow-alt' color='white'></box-icon>
                </button>
            </div>
        </form>
    </div>
@endsection
