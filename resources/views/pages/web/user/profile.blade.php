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

                                    @if ($advertisements->isEmpty())
                                        <div class="text-center mt-5">
                                            <div class="mb-3">
                                                <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                                                    alt="No advertisements graphic" width="200">
                                            </div>
                                            <p>Sorry, We can't find anything to show here.</p>
                                            <a href="{{ route('client.advertisement.show-create') }}"
                                                class="btn btn-success">Create New Advertisement</a>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <a href="{{ route('client.advertisement.show-create') }}"
                                                class="btn btn-success">Create New Advertisement</a>
                                        </div>
                                        <div class="mt-5">
                                            <nav>
                                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="ads-active-tab" data-bs-toggle="tab"
                                                        data-bs-target="#ads-active" type="button" role="tab">Active Advertisements</button>
                                                    <button class="nav-link" id="ads-unpaid-tab" data-bs-toggle="tab"
                                                        data-bs-target="#ads-unpaid" type="button" role="tab">Unpaid Advertisements</button>
                                                    <button class="nav-link" id="ads-expired-tab" data-bs-toggle="tab"
                                                        data-bs-target="#ads-expired" type="button" role="tab">Expired Advertisements</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="ads-active" role="tabpanel"
                                                    aria-labelledby="ads-active-tab">
                                                    <div class="mt-3 py-3">
                                                        <h4>Active Advertisements</h4>

                                                        @forelse ($advertisements->get('active') as $active)
                                                        <div class="card border-success mt-3">
                                                            <div class="card-body">
                                                                <h4 class="card-text">{{ $active->title }}</h4>
                                                                <small>Created at: {{ $active->created_at->format('Y-m-d h:i A') }}</small>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="{{ route('advertisement.promote.show', $active->id) }}" class="btn btn-primary">
                                                                    Promote Advertisement
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="text-center mt-5">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                                                                    alt="No advertisements graphic" width="200">
                                                            </div>
                                                            <p>Sorry, you have no active advertisements at the moment.</p>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="ads-unpaid" role="tabpanel"
                                                    aria-labelledby="ads-unpaid-tab">
                                                    <div class="mt-3 py-3">
                                                        <h4>Unpaid Advertisements</h4>
                                                        @forelse ($advertisements->get('unpaid') as $unpaid)
                                                        <div class="card border-success mt-3">
                                                            <div class="card-body">
                                                                <h4 class="card-text">{{ $unpaid->title }}</h4>
                                                                <small>Created at: {{ $unpaid->created_at->format('Y-m-d h:i A') }}</small>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="{{ route('advertisement.pay', $unpaid->id) }}" class="btn btn-success">
                                                                    Pay to publish
                                                                </a>
                                                                <a href="{{ route('advertisement.unpaid.edit.page', $unpaid->id) }}" class="btn btn-warning">
                                                                    Edit advertisement
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="text-center mt-5">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                                                                    alt="No advertisements graphic" width="200">
                                                            </div>
                                                            <p>You have no unpaid advertisements at the moment.</p>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="ads-expired" role="tabpanel"
                                                    aria-labelledby="ads-expired-tab">
                                                    <div class="mt-3 py-3">
                                                        <h4>Expired Advertisements</h4>
                                                        @forelse ($advertisements->get('expired') as $expired)
                                                        <div class="card border-success mt-3">
                                                            <div class="card-body">
                                                                <h4 class="card-text">{{ $expired->title }}</h4>
                                                                <small>Created at: {{ $expired->created_at->format('Y-m-d h:i A') }}</small>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="{{ route('advertisement.renew.show', $expired->id) }}" class="btn btn-info">
                                                                    Renew
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="text-center mt-5">
                                                            <div class="mb-3">
                                                                <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                                                                    alt="No advertisements graphic" width="200">
                                                            </div>
                                                            <p>You have no expired advertisements at the moment.</p>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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

@section('custom-css')
@endsection
