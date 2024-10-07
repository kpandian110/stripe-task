<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Product;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request, $productId)
    {
        // Get the product by ID
        $product = Product::findOrFail($productId);

        // Set Stripe API secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => $product->price * 100,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true
            ]
        ]);

        // Send the client secret back to the frontend
        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
            'payment_intent_id' => $paymentIntent->id,
        ]);
    }

    // Handle successful payment redirection
    public function paymentSuccess(Request $request)
    {
        return view('payments.success');
    }
}
