<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmacyMedicine;
use App\Models\Medicine; // Import the Medicine model

class MedicineOrderController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $pharmacy_medicines = PharmacyMedicine::whereHas('medicine', function($query) use ($user_id) {
            $query->where('maker_id', $user_id);
        })->get();

        return view('order.index', compact('pharmacy_medicines'));
    }

    public function store(Request $request)
    {
        // Handle the order logic here
        // ...

        return redirect()->route('medicines.order')->with('success', 'Order placed successfully.');
    }

    public function update(Request $request, $id)
    {
        $pharmacy_medicine = PharmacyMedicine::find($id);
        if ($pharmacy_medicine) {
            $pharmacy_medicine->price = $request->input('price');
            $pharmacy_medicine->save();
            return redirect()->route('pharmacy_medicines.index')->with('success', 'Price updated successfully.');
        }
        return redirect()->route('pharmacy_medicines.index')->with('error', 'Pharmacy medicine not found.');
    }

    public function updateByPharmacyMedicineId(Request $request, $id)
    {
        $pharmacy_medicine = PharmacyMedicine::find($id);
        if ($pharmacy_medicine) {
            $pharmacy_medicine->price = $request->input('price');
            $pharmacy_medicine->save();
            return redirect()->route('pharmacy_medicines.index')->with('success', 'Price updated successfully.');
        }
        return redirect()->route('pharmacy_medicines.index')->with('error', 'Pharmacy medicine not found.');
    }

    public function updateQuantityAndPrice(Request $request, $id)
    {
        // Existing update function
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $pharmacy_medicine = PharmacyMedicine::find($id);
        $medicine = Medicine::find($pharmacy_medicine->medicine_id);

        if ($request->input('quantity') > $medicine->quantity) {
            return redirect()->route('pharmacy_medicines.index')
                             ->with('error', 'Insufficient quantity in stock');
        }

        $pharmacy_medicine->quantity = $request->input('quantity');
        $pharmacy_medicine->price = $request->input('price');
        $pharmacy_medicine->save();

        return redirect()->route('pharmacy_medicines.index')
                         ->with('success', 'Pharmacy Medicine updated successfully');
    }

    public function accept(Request $request, $id)
    {
        $pharmacy_medicine = PharmacyMedicine::find($id);
        if (!$pharmacy_medicine) {
            return redirect()->route('pharmacy_medicines.index')
                             ->with('error', 'Pharmacy medicine not found');
        }

        $medicine = Medicine::find($pharmacy_medicine->medicine_id);
        if (!$medicine) {
            return redirect()->route('pharmacy_medicines.index')
                             ->with('error', 'Medicine not found');
        }

        if ($pharmacy_medicine->quantity > $medicine->quantity) {
            return redirect()->route('pharmacy_medicines.index')
                             ->with('error', 'Insufficient quantity in stock');
        }

        $pharmacy_medicine->status = 'accepted';
        $pharmacy_medicine->save();

        $medicine->quantity -= $pharmacy_medicine->quantity;
        $medicine->selled += $pharmacy_medicine->quantity;
        $medicine->save();

        return redirect()->route('pharmacy_medicines.index')
                         ->with('success', 'Pharmacy Medicine accepted successfully');
    }

    public function updatePriceById(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $pharmacy_medicine = PharmacyMedicine::find($id);
        if (!$pharmacy_medicine) {
            return redirect()->route('pharmacy_medicines.index')
                             ->with('error', 'Pharmacy medicine not found');
        }

        $pharmacy_medicine->price = $request->input('price');
        $pharmacy_medicine->save();

        return redirect()->route('pharmacy_medicines.index')
                         ->with('success', 'Price updated successfully');
    }
}
