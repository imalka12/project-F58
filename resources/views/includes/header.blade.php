{{-- is success message is sent with --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show notification-alert" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- if error message is sent with --}}
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show notification-alert" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- if info message is sent with --}}
@if (session('info'))
<div class="alert alert-info alert-dismissible fade show notification-alert" role="alert">
    {{ session('info') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<nav class="topnav py-2">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="{{ route('site.about') }}" class="nav-link link-dark px-2">About</a></li>
            <li class="nav-item"><a href="{{ route('site.pricing') }}" class="nav-link link-dark px-2">Pricing</a>
            </li>
            <li class="nav-item"><a href="{{ route('site.faq') }}" class="nav-link link-dark px-2">FAQs</a></li>
            <li class="nav-item"><a href="{{ route('site.contact') }}" class="nav-link link-dark px-2">Contact Us</a>
            </li>
        </ul>
        <ul class="nav">
            @auth
                <li class="nav-item">
                    <a href="{{ route('client.profile') }}" class="nav-link link-dark px-2">
                        Welcome, {{ auth()->user()->firstname }}!
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('client.process-logout') }}" class="d-inline" method="post"
                        onsubmit="return confirm('Are you sure you want to logout?')">
                        @csrf
                        <button type="submit" class="btn btn-info">Logout</button>
                    </form>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    <a href="{{ route('client.login') }}" class="nav-link link-dark px-2">Login</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<header class="py-3" id="top-header-main">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="{{ route('site.home') }}"
            class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-white text-decoration-none">
            <img class="me-2" src="{{ asset('assets/images/logo-icon-white.png') }}" alt="Logo Icon"
                width="24" height="24">
            <span class="fs-4">Quick Ads</span>
        </a>
        @auth
            <a href="/" class="btn btn-warning text-white">Post Your Ad</a>
        @endauth
    </div>
</header>
