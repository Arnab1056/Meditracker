<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Cart;
use App\Models\PharmacyMedicine;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    public function add($id, Request $request)
    {
        // Get the medicine and its price from the pharmacy_medicines table
        $pharmacyMedicine = PharmacyMedicine::find($id);
        if ($pharmacyMedicine) {
            $medicine = Medicine::find($pharmacyMedicine->medicine_id);
            if ($medicine) {
                return view('cart.add', [
                    'medicine' => $medicine,
                    'price' => $pharmacyMedicine->price,
                    'pharmacy_id' => $pharmacyMedicine->pharmacy_id // Include pharmacy_id
                ]);
            }
        }
        return redirect()->back()->with('error', 'Medicine not found!');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'medicine_id' => 'required|integer|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'pharmacy_id' => 'required|integer|exists:pharmacies,id', // Validate pharmacy_id
        ]);

        // Logic to add the medicine to the cart
        Cart::create([
            'user_id' => $request->user_id,
            'medicine_id' => $request->medicine_id,
            'pharmacy_id' => $request->pharmacy_id, // Use pharmacy_id from the request
            'quantity' => $request->quantity,
            'payment_method' => 'Cash On Delivery',
            'payment_status' => 'Pending',
            'payment_date'=>now(),
            'total_amount'=> $request->quantity*$request->price,// Set payment_status to 'cashondelivery'
            'price' => $request->price, // Include price
        ]);

        return redirect()->route('cart.show')->with('success', 'Medicine added to cart!');
    }

    public function show()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        return view('cart.show', compact('cartItems'));
    }

    public function remove($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem && $cartItem->user_id == auth()->user()->id) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart!');
        }
        return redirect()->back()->with('error', 'Item not found!');
    }

    public function stripeCheckout(Request $request)
    {
        // Validate the request to ensure required fields are present
        $request->validate([
            'medicine_id' => 'required|integer|exists:medicines,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1', // Ensure quantity is validated
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => Medicine::find($request->input('medicine_id'))->name, // Fetch medicine name
                    ],
                    'unit_amount' => $request->input('price') * 100,
                ],
                'quantity' => $request->input('quantity', 1), // Added fallback for quantity
            ]],
            'mode' => 'payment',
            'success_url' => route('cart.success'),
            'cancel_url' => route('cart.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('cart.success');
    }

    public function cancel()
    {
        return view('cart.cancel');
    }
}
