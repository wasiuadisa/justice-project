<?php
$pageTitle = "Error 500! - ";
$pageTag =  strtolower($pageTitle) . '-' . config('app.short_name');
?>

@section('extra_meta')
    <meta name="robots" content="noindex,nofollow">
@endsection

@section('pageTitle') {{ $pageTitle }} @endsection

@extends('layouts.public_template')

@section('main_contents')
    <section id="gtco-practice-areas" data-section="practice-areas" style="margin-top: 20px;">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-8 col-md-offset-2 heading animate-box" data-animate-effect="fadeIn">
                    <h1>{{ $pageTitle }} - Internal Server Error</h1>
                    <p class="subtle-text animate-box" data-animate-effect="fadeIn">Practice <span>Areas</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <p>The Page you are looking for won't load because the server has encountered an error while processing your requested page.</p>
                    <a href="{{ route('index') }}" class="btn btn-primary">Take me to Home page</a>
                </div>
            </div>
        </div>
    </section>
@endsection
