<div class="row">
    <div class="col-lg-12">
        <h2>Advertisements</h2>

        @if (auth()->user()->profile->isIncomplete())
            <div class="alert alert-warning">
                Your profile is incomplete. Please complete your profile to continue.
            </div>
        @else
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
                            <button class="nav-link active" id="ads-active-tab"
                                data-bs-toggle="tab" data-bs-target="#ads-active" type="button"
                                role="tab">Active Advertisements</button>
                            <button class="nav-link" id="ads-unpaid-tab"
                                data-bs-toggle="tab" data-bs-target="#ads-unpaid" type="button"
                                role="tab">Unpaid Advertisements</button>
                            <button class="nav-link" id="ads-expired-tab"
                                data-bs-toggle="tab" data-bs-target="#ads-expired" type="button"
                                role="tab">Expired Advertisements</button>
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
                                            <h4 class="card-text">{{ $active->title }}
                                            </h4>
                                            <small>Created at:
                                                {{ $active->created_at->format('Y-m-d h:i A') }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('advertisement.promote.show', $active->id) }}"
                                                class="btn btn-primary">
                                                Promote Advertisement
                                            </a>
                                            <a href="{{ route('ads.view.single', $active->id) }}"
                                                class="btn btn-success">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center mt-5">
                                        <div class="mb-3">
                                            <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                                                alt="No advertisements graphic" width="200">
                                        </div>
                                        <p>Sorry, you have no active advertisements at the
                                            moment.</p>
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
                                            <h4 class="card-text">{{ $unpaid->title }}
                                            </h4>
                                            <small>Created at:
                                                {{ $unpaid->created_at->format('Y-m-d h:i A') }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('advertisement.pay', $unpaid->id) }}"
                                                class="btn btn-success">
                                                Pay to publish
                                            </a>
                                            <a href="{{ route('advertisement.unpaid.edit.page', $unpaid->id) }}"
                                                class="btn btn-warning">
                                                Edit advertisement
                                            </a>
                                            <form action="{{ route('selected.advertisement.delete', $unpaid->id) }}" 
                                                method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
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
                                            <h4 class="card-text">{{ $expired->title }}
                                            </h4>
                                            <small>Created at:
                                                {{ $expired->created_at->format('Y-m-d h:i A') }}</small>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('advertisement.renew.show', $expired->id) }}"
                                                class="btn btn-info">
                                                Renew
                                            </a>
                                            <form action="{{ route('selected.advertisement.delete', $expired->id) }}" 
                                                method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
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
        @endif
    </div>
</div>