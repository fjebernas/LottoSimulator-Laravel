@extends('layouts.app')

@section('content')
    <h1 class='custom-h1'>Create new ticket:</h1>

    <form action="/tickets" method="POST">
        @csrf
        <fieldset class="d-flex align-content-start flex-wrap w-75">
            @for ($i = $digits_range['min']; $i <= $digits_range['max']; $i++)
            <div class="form-check d-flex align-items-center">
                <input type="checkbox" class="form-check-input" name="digits[]" value="{{ $i }}" id="{{ $i }}">
                <label class="form-check-label" for="{{ $i }}">{{ $i }}</label>
            </div>
        @endfor
        </fieldset>

        <div class="buttons">
            <a href="/tickets" class="btn btn-danger">Go back</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection
