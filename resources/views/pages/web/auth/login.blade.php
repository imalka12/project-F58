@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="col-6 border-end">
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
            <div class="col-6 px-5">
                <div id="form-wrapper">
                    <form action="{{ route('client.process-login') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="email_address" class="mb-2">Email Address</label>
                            <input type="email" name="email_address" id="email_address"
                                class="form-control @error('email_address') is-invalid @enderror"
                                value="{{ old('email_address') }}">
                            @error('email_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember_me"
                                    name="remember_me" value="1">
                                <label class="form-check-label" for="remember_me">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary d-block"
                                    name="send_client_login">Login</button>
                            </div>
                        </div>

                        <div class="form-group mt-2 text-center">
                            <a href="{{ route('client.forgot-password') }}">Forgot password?</a>
                        </div>

                        <div class="form-group mt-2">
                            <h6 class="text-center">Don't have an account yet?</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('client.signup') }}" class="btn btn-secondary">Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
