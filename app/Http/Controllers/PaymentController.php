<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function processPayment(Request $request, Advertisement $advertisement)
    {
        $amount = config('system.payments.advertisement_publish') * 100;

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create ([
            "amount" => $amount,
            "currency" => "lkr", // currency is set to Sri Lankan Rupees
            "source" => $request->stripeToken,
            "description" => "Publishing fee for " . $advertisement->title, 
        ]);

        // create payment for advertisement
        $payment = Payment::create([
            'user_id' => auth()->user()->id, 
            'advertisement_id' => $advertisement->id, 
            'amount' => $amount,
            'request_code' => $request->stripeToken, 
            'response_code' => $charge->id, 
            'status' => $charge->status,
            'type' => 'publish',
        ]);

        $advertisement->payment_id = $payment->id;
        $advertisement->is_approved = true;
        $advertisement->expire_at = now()->addWeeks(3)->format('Y-m-d H:i:s');
        $advertisement->save();

        return redirect()->route('client.profile')->with('success', 'Payment has been successfully processed.');
    }
}
