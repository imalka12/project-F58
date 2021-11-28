@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="col-lg-6 col-md-8 col-sm-12">
                    {{ @session('status') }}
                </div>
            @endif

            <div class="col-lg-6 col-md-8 col-sm-12">
                <h2>Update Your Password</h2>
                <p>Enter your new password and confirm it. Then click the button to submit the update request.</p>

                <form action="{{ route('password.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email address here..." value="{{ old('email', $email) }}" readonly>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password here..." autofocus>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Enter your password again here...">
                    </div>

                    <div class="mb-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update my password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
