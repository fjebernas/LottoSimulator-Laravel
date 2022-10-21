@extends('layouts.app')

@section('customjs')
    <script src="/js/ticket/create.js" defer></script>
@endsection

@section('content')
    <h1 class='custom-h1'>/js/{{ Request::segment(1) }}/{{ Request::segment(2) }}.js</h1>

    <div class="form-check mb-3 ml-3">
        <input class="form-check-input" type="checkbox" value="" id="chkbx-random-digits">
        <label class="form-check-label text-muted" for="chkbx-random-digits">
        Random digits
        </label>
    </div>

    <form action="/tickets" method="POST">
        @csrf
        <fieldset class="d-flex align-content-start flex-wrap d-flex">
            @for ($i = $digits_range['min']; $i <= $digits_range['max']; $i++)
            <div class="form-check form-check-digits form-check-inline position-relative">
                <label class="form-check-label create-ticket position-relative" for="{{ $i }}">
                    <input type="checkbox" class="form-check-input form-check-input-digits" name="digits[]" value="{{ $i }}" id="{{ $i }}">{{ $i }}
                </label>
            </div>
        @endfor
        </fieldset>

        <div class="buttons py-3">
            <a href="/tickets" class="btn btn-danger">Go back</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection
