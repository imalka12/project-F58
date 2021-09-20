@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row justify-content-center">
            @if (session('forgot_password_email_sent'))
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2>Email sent!</h2>
                    <p>Check your email now for an email from us with a special link to reset your password. If you have any
                        trouble using the button, please copy and paste the url to a new tab and continue.</p>
                </div>
            @endif

            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2>Forgot your password?</h2>
                <p>No worries. We can send an email to your email address so you can reset the password easily.</p>
                <p>Enter your email address you used to register in our website and click the button to start.</p>

                <form action="/" method="post">
                    @csrf

                    <div class="mb-4">
                        <input type="email" name="email_address" id="email_address" class="form-control"
                            placeholder="Enter your email address here..." autofocus>
                    </div>

                    <div class="mb-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Send me the email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
