@extends('layouts.web.master')

@section('contents')
<div class="container p-5">
    <div class="col-lg-12">
        <a href="{{ route('client.profile') }}" class="btn btn-outline-primary float-end">Go back to profile</a>
    </div>
    <div class="col-lg-12 mt-5">
        
        <div class="card pt-5">
            <div class="card-body">
                <h2 class="card-text text-center text-uppercase mb-4">Pay to Renew your advertisement</h2>
                <div class="row">
                    <div class="col-lg-6 py-5 pt-0 text-center">
                        <img src="{{ asset('storage/advs-images/' . $advertisement->advertisementImages->first()->image) }}" width="150">
                        <p>Item: <strong>{{ $advertisement->title }}</strong></p>
                        <div class="text-primary mt-5">
                            <h6>Pay Amount</h6>
                            <h3>LKR {{ number_format(config('system.payments.advertisement_extend'), 2) }}</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 py-3">
                        <p>Enter your card details to make the payment.</p>
                        <p><small>Payments handled by <strong class="text-primary">Stripe</strong></small></p>

                        <div class="error hide">
                            <div class="alert alert-danger"></div>
                        </div>

                        <form id="payment_form" action="{{ route('advertisement.renew.process', $advertisement->id) }}" method="post" data-has-token="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                            @csrf

                            <div class="mb-2">
                                <label for="name_on_card">Name on Card</label>
                                <input type="text" class="form-control" required="required" id="name_on_card" name="name_on_card">
                            </div> {{-- name on card --}}
                            
                            <div class="mb-2">
                                <label for="card_number">Card Number</label>
                                <input type="text" class="form-control" required="required" id="card_number" name="card_number">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="cvv">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <label for="expiry">Expire On</label>
                                        <input type="text" class="form-control" id="expiry" name="expiry" required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-100" id="submit-payment-card-details">Make Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-css')
<style>
    .hide {
        display: none;
    }
</style>
@endsection

@section('custom-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>

function setInputMasks() {
    // card number
    $('#card_number').mask('0000 0000 0000 0000');
    $('#cvv').mask('000');
    $('#expiry').mask('00/00');
}

$(function(){
    setInputMasks();
});

let $form = $('#payment_form');
$form.submit(function(e){
    if (!$form.data('has-token')) {
        e.preventDefault();

        // handle disabling button and showing loading text
        $('#submit-payment-card-details').html('Sending...');
        $('#submit-payment-card-details').prop('disabled', true);

        let expiry = $('#expiry').val().split('/');

        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            number: $('#card_number').val(),
            cvc: $('#cvv').val(),
            exp_month: expiry[0],
            exp_year: expiry[1],
        }, stripeHandleResponse);
    }
});

function stripeHandleResponse(status, response) {
    if (response.error) {
        $('.error').removeClass('hide')
            .find('.alert')
            .text(response.error.message);
    } else {
        var token = response['id'];
        $form.data('has-token', true);
        console.log(`token: ${token}`);
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.submit();
    }
}
</script>
@endsection