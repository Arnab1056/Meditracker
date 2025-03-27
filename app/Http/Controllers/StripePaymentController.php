<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\Models\Cart;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Validate the request
        $request->validate([
            'payment_method_id' => 'required|string',
            'user_id' => 'required|integer',
            'medicine_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'pharmacy_id' => 'required|integer',
        ]);

        try {
            // Create or retrieve a Stripe customer
            $customer = Customer::create([
                'payment_method' => $request->payment_method_id,
                'email' => auth()->user()->email,
                'invoice_settings' => [
                    'default_payment_method' => $request->payment_method_id,
                ],
            ]);

            // Create a payment intent
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->price * $request->quantity * 100, // Convert to cents
                'currency' => 'usd',
                'customer' => $customer->id,
                'payment_method' => $request->payment_method_id,
                'off_session' => true,
                'confirm' => true,
            ]);

            // Check if the payment was successful
            if ($paymentIntent->status === 'succeeded') {
                // Add information to the carts table
                Cart::create([
                    'user_id' => $request->user_id,
                    'medicine_id' => $request->medicine_id,
                    'pharmacy_id' => $request->pharmacy_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'payment_method' => 'stripe',
                    'payment_status'  => 'paid',
                    'payment_date'=> now(),
                    'total_amount'=> $request->price * $request->quantity,
                ]);

                return redirect()->route('cart.success')->with('success', 'Payment successful!');
            } else {
                return redirect()->route('cart.cancel')->with('error', 'Payment failed!');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.cancel')->with('error', $e->getMessage());
        }
    }
}