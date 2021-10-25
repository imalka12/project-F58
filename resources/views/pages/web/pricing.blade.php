@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        <div class="row">
            <div class="text-center">
                <h2>Pricing</h2>
                <div class="row mt-4">
                    <p>Sell your items quickly at the best price by making your ads stand out on Quick Ads - the largest
                        marketplace in Sri Lanka!</p>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 text-center mt-3">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h2>Publish Ads</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-price mb-4">
                            <h2>LKR {{ number_format(config('system.payments.advertisement_publish'), 2) }} <small class=" text-muted">/ 14
                                    Days</small></h2>
                        </div>
                        <div class="card-items">
                            <ul class="list-unstyled">
                                <li> <i class="fas fa-check text-primary"></i>
                                    Published advertisements will display 14 days.
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="card-btn mt-4">
                            <a href="{{ route('client.profile') }}" class="btn btn-primary btn-lg px-4 me-md-2 ">Post Your
                                Ad</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 text-center mt-3">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h2>Promote Ads</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-price mb-4">
                            <h2>LKR {{ number_format(config('system.payments.advertisement_promote'), 2) }} <small class=" text-muted">/ 14
                                    Days</small></h2>
                        </div>
                        <div class="card-items">
                            <ul class="list-unstyled">
                                <li>
                                    <i class="fas fa-check text-primary"></i>
                                    Promoted advertisements will show on top in listings.
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="card-btn mt-4">
                            <a href="{{ route('client.profile') }}" class="btn btn-primary btn-lg px-4 me-md-2 ">Post Your
                                Ad</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 text-center mt-3">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h2>Renew Ads</h2>
                    </div>
                    <div class="card-body">
                        <div class="card-price mb-4">
                            <h2>LKR {{ number_format(config('system.payments.advertisement_extend'), 2) }} <small class=" text-muted">/ 7
                                    Days</small></h2>
                        </div>
                        <div class="card-items">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-primary"></i>
                                    Renewed advertisements will display for another 7 days.
                                </li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="card-btn mt-4">
                            <a href="{{ route('client.profile') }}" class="btn btn-primary btn-lg px-4 me-md-2 ">Post Your
                                Ad</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
