<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyMedicine;
use App\Models\Pharmacy;

class SearchController extends Controller
{
    // Handle the search request and return the results
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = PharmacyMedicine::where('medicine_name', 'LIKE', "%{$query}%")
            ->where('quantity', '>', 0) // Ensure quantity is greater than 0
            ->where('status', '!=', 'pending') // Exclude pending status
            ->join('pharmacies', 'pharmacy_medicines.pharmacy_id', '=', 'pharmacies.id')
            ->get(['pharmacy_medicines.id', 'pharmacies.name as pharmacy_name', 'pharmacies.location as location', 'pharmacy_medicines.medicine_name', 'pharmacy_medicines.quantity', 'pharmacy_medicines.price'])
            ->map(function ($item) {
                $item->available = $item->quantity > 0 ? 'Yes' : 'No';
                return $item;
            });

        return view('search', compact('results'));
    }

    // Handle the buy request for a medicine
    public function buy($id)
    {
        // Implement the logic to add the medicine to the pharmacy delivery page
        return response()->json(['message' => 'Medicine has been added to your delivery.']);
    }
}
