@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-6 col-sm-12 border-lg-end">
                <h2>Post an ad</h2>
                <p>Login to post your ad and keep track of it in your account.</p>
                <ul id="site-feature-list-login">
                    <li class="feature-item">
                        <img src="{{ asset('assets/images/website-icons/note32.png') }}" alt="Post your own ads.">
                        Post your own ads.
                    </li>
                    <li class="feature-item">
                        <img src="{{ asset('assets/images/website-icons/favourite32.png') }}"
                            alt="Save your favourite ads and view them later.">
                        Save your favourite ads and view them later.
                    </li>
                    <li class="feature-item">
                        <img src="{{ asset('assets/images/website-icons/add32.png') }}"
                            alt="Create and manage your ads at your convenience.">
                        Create and manage your ads at your convenience.
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 px-lg-5">
                <div id="form-wrapper">
                    <form action="{{ route('client.process-signup') }}" method="post" class="row">
                        @csrf

                        <div class="col-lg-6 col-md-12 form-group mb-4">
                            <label for="firstname" class="mb-2">First Name</label>
                            <input type="text" id="firstname" name="firstname"
                                class="form-control @error('firstname') is-invalid @enderror"
                                value="{{ old('firstname') }}">
                            @error('firstname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-lg-6 col-md-12 form-group mb-4">
                            <label for="lastname" class="mb-2">Last Name</label>
                            <input type="text" id="lastname" name="lastname"
                                class="form-control @error('lastname') is-invalid @enderror"
                                value="{{ old('lastname') }}">
                            @error('lastname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="email_address" class="mb-2">Email Address</label>
                            <input type="email" name="email_address" id="email_address"
                                class="form-control @error('email_address') is-invalid @enderror"
                                value="{{ old('email_address') }}">
                            @error('email_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-12 form-group mt-4">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-12 form-group mt-4">
                            <label for="password_confirmation" class="mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password') is-invalid @enderror">
                        </div>

                        <div class="col-lg-12 form-group mt-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary d-block" name="send_client_login">Sign
                                    Up</button>
                            </div>
                        </div>

                        <div class="col-lg-12 form-group mt-4">
                            <h6 class="text-center">Already have an account?</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('client.login') }}" class="btn btn-secondary">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
