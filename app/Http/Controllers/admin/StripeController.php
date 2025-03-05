<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Product;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{

    public function createCheckoutSession(Request $request)
    {
        $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => 'price_1Pq0tE02cXnldqSPfqFcjaGf',
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
            'success_url' => route('checkout.success'). '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);
        // $data = [
        //     'user_id' => auth()->user()->id,
        //     'stripe_price_id' => 'price_1Pq0tE02cXnldqSPfqFcjaGf',
        //     'quantity' => 1,
        //     'stripe_session_id' => $session->id,
        //     'completed' => false,
        // ];
        return response()->json(['id' => $session->id]);
    }
    public function getStripeProducts(Request $request)
    {
        // Stripe::setApiKey(env('STRIPE_SECRET'));
        // $products = \Stripe\Product::all();

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $products = Product::all();
        foreach ($products->data as $product) {
            $price = \Stripe\Price::retrieve($product->default_price);
            $product->price_amount = $price->unit_amount/100; // Store the price amount
            $product->currency = $price->currency; // Store the currency if needed
        }
        return response()->json($products);
    }
    public function success(Request $request)
    {
        return redirect('/?payment=success');
    }

    public function cancel()
    {
        return redirect('/?payment=failed');
    }
}
