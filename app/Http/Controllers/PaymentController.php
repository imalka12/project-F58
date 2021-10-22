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
        $advertisement->save();

        return redirect()->route('client.profile')->with('success', 'Payment has been successfully processed.');
    }

    public function processPromotePayment(Request $request , Advertisement $advertisement)
    {
        $amount = config('system.payments.advertisement_promote') * 100;

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create ([
            "amount" => $amount,
            "currency" => "lkr", // currency is set to Sri Lankan Rupees
            "source" => $request->stripeToken,
            "description" => "Promotion fee for " . $advertisement->title, 
        ]);

        // promote payment for advertisement
        $payment = Payment::create([
            'user_id' => auth()->user()->id, 
            'advertisement_id' => $advertisement->id, 
            'amount' => $amount,
            'request_code' => $request->stripeToken, 
            'response_code' => $charge->id, 
            'status' => $charge->status,
            'type' => 'promote',
        ]);

        $advertisement->payment_id = $payment->id;
        $advertisement->is_promoted = true;
        $advertisement->save();

        return redirect()->route('client.profile')->with('success', 'Promoted Payment has been successfully processed.');
        
    }

    public function processRenewPayment(Request $request , Advertisement $advertisement)
    {
        $amount = config('system.payments.advertisement_extend') * 100;

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create ([
            "amount" => $amount,
            "currency" => "lkr", // currency is set to Sri Lankan Rupees
            "source" => $request->stripeToken,
            "description" => "Renewal fee for " . $advertisement->title, 
        ]);

        // renewal payment for advertisement
        $payment = Payment::create([
            'user_id' => auth()->user()->id, 
            'advertisement_id' => $advertisement->id, 
            'amount' => $amount,
            'request_code' => $request->stripeToken, 
            'response_code' => $charge->id, 
            'status' => $charge->status,
            'type' => 'renew',
        ]);

        $advertisement->payment_id = $payment->id;
        $advertisement->renewed_at = now()->format('Y-m-d H:i:s');
        $advertisement->expire_at = now()->addWeek()->format('Y-m-d H:i:s');
        $advertisement->save();

        return redirect()->route('client.profile')->with('success', 'Renewal Payment has been successfully processed.');
        
    }
}
