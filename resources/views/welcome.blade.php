@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/welcome.css">
@endsection

@section('customjs')
    <script src="/js/welcome.js" defer></script>
@endsection

@section('content')
    <div class="container col-xxl-10 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="https://media.philstar.com/photos/2020/11/02/lotto_2020-11-02_21-04-34.jpg" class="shadow rounded d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Lotto Game Simulator</h1>
                <p class="lead">A lottery is a form of gambling that involves the drawing of numbers at random for a prize. Some governments outlaw lotteries, while others endorse it to the extent of organizing a national or state lottery. It is common to find some degree of regulation of lottery by governments.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="/tickets" class="btn btn-primary btn-lg px-4 me-md-2">Play now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
