@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/lottotype/create.css">
@endsection

@section('customjs')
    <script src="/js/lottotype/create.js" type="module"></script>
@endsection

@section('content')
    <h1>Create a custom Lotto game:</h1>

    <div class="form-container d-flex flex-column">
        <form action="/lottotype" method="POST">
            @csrf
            <div class="form-group pb-3">
                <label for="lotto-name">Name of your custom Lotto game:</label>
                <input name="name" type="text" class="form-control" id="lotto-name" placeholder="Custom Lotto 5/20">
            </div>
        
            <div class="form-group pb-3">
                <label for="lotto-combination-count">Combination count:</label>
                <input name="combination_count" type="number" class="form-control" id="lotto-combination-count" placeholder="5">
            </div>
        
            <h6 class="pb-2 m-0">Digits range:</h6>
            <fieldset class="row gx-2">
                <div class="col input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">min</span>
                    <input name="digits_range[]" type="number" class="form-control text-center" placeholder="1" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="col input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">max</span>
                    <input name="digits_range[]" type="number" class="form-control text-center" placeholder="20" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </fieldset>
        
            <div class="form-group p-0 m-0">
                <label for="lotto-color-theme">Color theme:</label>
                <input name="color_theme" type="text" class="form-control" id="lotto-color-theme" placeholder="blue">
            </div>

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
