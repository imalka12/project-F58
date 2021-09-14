@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-12">
                <h2>Hello {{ auth()->user()->firstname }}!</h2>
                @if ($user->status === 'inactive')
                    <div class="alert alert-warning">
                        Your account is inactive. Did you verify your email address yet?
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
