<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Pharmacy;
use App\Models\PharmacyMedicine;
use App\Models\Order; // Import the Order model

class OrderController extends Controller
{
    public function index()
    {
        $orders = Cart::whereIn('status', ['pending', 'accepted', 'declined'])
                      ->whereHas('pharmacy', function($query) {
                          $query->where('email', auth()->user()->email);
                      }) // Filter by logged-in pharmacy email
                      ->get(); // Fetch orders with pending, accepted, or declined status
        return view('cart.orders', compact('orders'));
    }

    public function accept($id)
    {
        $order = Cart::find($id);
        if ($order && $order->pharmacy->email == auth()->user()->email) { // Check if order belongs to logged-in pharmacy
            // Decrease the quantity of the medicine in the pharmacy_medicines table
            $pharmacyMedicine = PharmacyMedicine::where('medicine_id', $order->medicine_id)
                                                ->where('pharmacy_id', $order->pharmacy_id)
                                                ->first();
            if ($pharmacyMedicine) {
                if ($pharmacyMedicine->quantity >= $order->quantity) {
                    // Logic to mark the order as accepted
                    $order->status = 'accepted';
                    $order->save();

                    $pharmacyMedicine->quantity -= $order->quantity;
                    $pharmacyMedicine->sold += $order->quantity; // Increase the sold value
                    $pharmacyMedicine->save();

                    return redirect()->back()->with('success', 'Order accepted successfully!');
                } else {
                    return redirect()->back()->with('error', 'Insufficient quantity available.');
                }
            }
        } 
        return redirect()->back()->with('error', 'Order not found!');
    }

    public function decline(Cart $order)
    {
        if ($order->pharmacy->email == auth()->user()->email) { // Check if order belongs to logged-in pharmacy
            $order->status = 'declined';
            $order->save();
            return redirect()->route('orders.index')->with('success', 'Order declined successfully.');
        }
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }

    public function remove($id)
    {
        $order = Cart::find($id);
        if ($order && $order->pharmacy->email == auth()->user()->email) { // Check if order belongs to logged-in pharmacy
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Order removed successfully.');
        }
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }
}
