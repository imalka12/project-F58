@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <h2>Hello {{ auth()->user()->firstname }}!</h2>
            </div>
        </div>
    </div>

@endsection
