@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2>Verify your email address</h2>
                <p>Your account created successfully.</p>
                <p>We have sent you an email to your email address to very your email address.</p>
                <p>Click the link on the verification email to start.</p>
                <div class="mt-4">
                    <p>Didn't receive the email yet?</p>
                    <p>Click the button below to resend the email.</p>
                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">Resend Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
