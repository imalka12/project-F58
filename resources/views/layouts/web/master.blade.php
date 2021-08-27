<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/web.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <nav class="topnav py-2 border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Contacts</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Login</a></li>
                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Sign up</a></li>
            </ul>
        </div>
    </nav>
    <header class="py-3" id="top-header-main">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-white text-decoration-none">
                <img class="me-2" src="{{ asset('assets/images/logo-icon-white.png') }}" alt="Logo Icon" width="24" height="24">
                <span class="fs-4">Quick Ads</span>
            </a>
            <a href="/" class="btn btn-warning text-white">Post Your Ad</a>
        </div>
    </header>
    <div id="home-search-big">
        <div class="container mye-5 py-lg-5">
            <form action="/" method="post" id="home-search-form" onsubmit="return false">
                @csrf
                <input type="search" name="search" id="home-search-anything" placeholder="What are you looking for today?">
                <button type="submit" id="search-button"><img src="{{  asset('assets/images/search.png') }}" alt="" height="38px"></button>
            </form>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <h4>Browse advertisements by category</h4>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/car.png') }}" alt="Automobiles">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Automobiles</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/house.png') }}" alt="Property">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Property</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/tv-monitor.png') }}" alt="Electronics">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Electronics</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/smartphone.png') }}" alt="Mobile Phones">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Mobile Phones</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/electric-guitar.png') }}" alt="Musical Instruments">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Musical Instruments</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/vaccum-cleaner.png') }}" alt="Household Equipments">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Household Equipments</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/sports.png') }}" alt="Sporting Equipments">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Sporting Equipments</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/microwave.png') }}" alt="Kitchen Appliances">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Kitchen Appliances</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/gamepad.png') }}" alt="Gaming">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Gaming</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/weights.png') }}" alt="Fitness">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Fitness</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center p-4">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/images/category-icons/power-saw.png') }}" alt="Power Tools">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Power Tools</h5>
                        <small>1000 Advertisements</small>
                    </div>
                </div></div>
                <div class="col-lg-3">
                    <div class="d-flex align-items-center p-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('assets/images/category-icons/book.png') }}" alt="Educational">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Educational</h5>
                            <small>1000 Advertisements</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-5 home-hero">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center">
                <div class="col-lg-4 offset-lg-1 p-0 mx-lg-5">
                    <img src="{{ asset('assets/images/hero-ad-image.svg') }}" alt="" width="400">
                </div>
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h1 class="display-4 fw-bold lh-1">Quick Advertisements</h1>
                    <p class="lead">Why waste time on multiple ad websites posting your advertisements? Quickly post your ad with cheapest rates and get the best coverage for your ad.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Post Your Ad</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer-wrapper">
            <div class="container">
                <footer class="py-5">
                    <div class="row">
                        <div class="col-2">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Home</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Features</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">About</a></li>
                            </ul>
                        </div>
                        
                        <div class="col-2">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Home</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Features</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">About</a></li>
                            </ul>
                        </div>
                        
                        <div class="col-2">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Home</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Features</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">Pricing</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">FAQs</a></li>
                                <li class="nav-item mb-2"><a href="#" class="nav-link p-0">About</a></li>
                            </ul>
                        </div>
                        
                        <div class="col-4 offset-1">
                            <form>
                                <h5>Subscribe to our newsletter</h5>
                                <p>Get advertisements delivered directly to your inbox</p>
                                <div class="d-flex w-100 gap-2">
                                    <label for="newsletter1" class="visually-hidden">Email address</label>
                                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                                    <button class="btn btn-outline-light" type="button">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between py-4 mys-4 border-top">
                        <p>&copy; 2021 {{ config('app.name') }}. Designed and developed by {{ config('system.developer.name') }}</p>
                        <ul class="list-unstyled d-flex">
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                        </ul>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    </html>