<div class="row">
    <div class="col-lg-12">
        <h2>Payments</h2>

        @forelse ($payments as $payment)
            <div class="card mb-2 {{ $payment->type == 'promote' ? 'promoted-ad-block' : '' }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="p-2">
                                <img src="{{ asset('storage/advs-images/' . $payment->advertisement->advertisementImages->first()->image) }}" alt="" width="100">
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-6">
                            <div class="ms-3">
                                <small>{{ $payment->created_at->diffForHumans() }}</small>
                                <h4 class="card-title">LKR {{ number_format($payment->amount / 100, 2) }}</h4>
                                <p class="card-text">
                                    Paid <strong>{{ $paymentTypes[$payment->type] }}</strong> 
                                    Advertisement: {{ $payment->advertisement->title }} <br />
                                    <small>Ref. No. : 
                                        <span class="badge bg-primary">{{ $payment->response_code }}</span>
                                    </small> 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="text-center mt-5">
            <div class="mb-3">
                <img src="{{ asset('assets/images/site-images/undraw_No_data_re_kwbl.svg') }}"
                    alt="No payments graphic" width="200">
            </div>
            <p>Sorry, you have no payments details to show at the moment.</p>
        </div>
        @endforelse
    </div>
</div>