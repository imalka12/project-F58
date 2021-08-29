@extends('layouts.web.master')

@section('contents')

<div id="home-search-big">
    <div class="container mye-5 py-lg-5">
        <form action="/" method="post" id="home-search-form" onsubmit="return false">
            @csrf
            <input type="search" name="search" id="home-search-anything" placeholder="What are you looking for today?">
            <button type="submit" id="search-button"><img src="{{  asset('assets/images/search.png') }}" alt="" height="38px"></button>
        </form>
    </div>
</div>

@include('includes.home-catgeories')

<div class="container my-5 home-hero">
    <div class="row p-5">
        <div class="col-lg-5">
            <img src="{{ asset('assets/images/hero-ad-image.svg') }}" alt="" width="400">
        </div>
        <div class="col-lg-7">
            <h1 class="display-4 fw-bold lh-1">Quick Advertisements</h1>
            <p class="lead">Why waste time on multiple ad websites posting your advertisements? Quickly post your ad with cheapest rates and get the best coverage for your ad.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Post Your Ad</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Learn More</button>
            </div>
        </div>
    </div>
</div>

@endsection