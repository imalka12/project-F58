@extends('layouts.web.master')

@section('contents')
    <div class="container p-5">
        @if ($user->status === 'inactive')
            <div class="alert alert-warning">
                Your account is inactive. Did you verify your email address yet?
            </div>
        @else
            <div class="row">
                <div class="col-lg-4">
                    <h2>Hello {{ auth()->user()->firstname }}!</h2>
                    <aside class="mt-5">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item mb-3">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile" href="#">My
                                    Profile</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ads" href="#">My
                                    Advertisements</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#payments" href="#">My
                                    Payments</a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#settings"
                                    href="#">Settings</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            @include('includes.client-profile-tab')
                        </div>
                        <div class="tab-pane fade" id="ads" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Advertisements</h2>
                                    <div class="text-center mt-5">
                                        <div class="mb-3">
                                            <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}" alt="No advertisements graphic" width="200">
                                        </div>
                                        <p>Sorry, We can't find anything to show here.</p>
                                        <a href="#" class="btn btn-success">Let's Create an Advertisement</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel">
                            <h2>Payments</h2>
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel">
                            <h2>Settings</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
