@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2>Forgot your password?</h2>
                <p>No worries. We can send an email to your email address so you can reset the password easily.</p>
                <p>Enter your email address you used to register in our website and click the button to start.</p>

                <form action="{{ route('password.email') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email address here..." value="{{ old('email') }}" autofocus required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
