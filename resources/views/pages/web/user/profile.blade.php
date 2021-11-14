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
                            @include('pages.web.user.profile-advertisements')
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel">
                            @include('pages.web.user.profile-payments')
                        </div>
                        <div class="tab-pane fade" id="settings" role="tabpanel">
                            @include('pages.web.user.profile-settings')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('custom-css')
@endsection
