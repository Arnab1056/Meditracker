<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\PharmacyMedicine;
use App\Models\Medicine; // Add this line

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacy = auth()->user()->pharmacy;
        $pharmacyMedicines = PharmacyMedicine::where('pharmacy_id', $pharmacy->id)->paginate(10);
        return view('pharmacies.index', compact('pharmacy', 'pharmacyMedicines'))->with('i', 0);
    }

    public function medicines($pharmacyId)
    {
        $pharmacy = Pharmacy::find($pharmacyId);
        $medicines = Medicine::paginate(10);
        return view('pharmacies.medicines', compact('pharmacy', 'medicines'))->with('i', 0);
    }

    public function sell(Request $request, $medicineId)
    {
        $request->validate([
            'sellQuantity' => 'required|integer|min:1',
        ]);

        $pharmacy = auth()->user()->pharmacy;
        $pharmacyMedicine = PharmacyMedicine::where('pharmacy_id', $pharmacy->id)
                                            ->where('medicine_id', $medicineId)
                                            ->first();

        if ($pharmacyMedicine) {
            if ($pharmacyMedicine->quantity < $request->sellQuantity) {
                return redirect()->route('pharmacies.index')
                                 ->with('error', 'Not available quantity.');
            }

            $pharmacyMedicine->quantity -= $request->sellQuantity;
            $pharmacyMedicine->sold += $request->sellQuantity;
            $pharmacyMedicine->save();

            return redirect()->route('pharmacies.index')
                             ->with('success', 'Medicine sold successfully.');
        }

        return redirect()->route('pharmacies.index')
                         ->with('error', 'Medicine not found.');
    }

    public function destroyMedicine($id)
    {
        $pharmacyMedicine = PharmacyMedicine::find($id);
        if ($pharmacyMedicine) {
            $pharmacyMedicine->delete();
            return redirect()->route('pharmacies.index')
                             ->with('success', 'Medicine deleted successfully.');
        }

        return redirect()->route('pharmacies.index')
                         ->with('error', 'Medicine not found.');
    }

    public function showMedicine($id)
    {
        $pharmacyMedicine = PharmacyMedicine::find($id);
        $medicine = Medicine::find($pharmacyMedicine->medicine_id);
        return view('pharmacies.show_medicine', compact('pharmacyMedicine', 'medicine'));
    }

    public function editMedicine($id)
    {
        $pharmacyMedicine = PharmacyMedicine::find($id);
        return view('pharmacies.edit_medicine', compact('pharmacyMedicine'));
    }

    public function addMedicineForm($pharmacyId, $medicineId)
    {
        $pharmacy = Pharmacy::find($pharmacyId);
        $medicine = Medicine::find($medicineId);
        return view('pharmacies.add_medicine_details', compact('pharmacy', 'medicine'));
    }

    public function storeMedicine(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'sold' => 'required|integer',
            'status' => 'nullable|string'
        ]);

        $medicine = Medicine::find($request->medicine_id);
        $pharmacy = auth()->user()->pharmacy;

        $pharmacyMedicine = PharmacyMedicine::where('pharmacy_id', $pharmacy->id)
                                            ->where('medicine_id', $request->medicine_id)
                                            ->first();

        if ($pharmacyMedicine) {
            // Update existing record
            $pharmacyMedicine->quantity += $request->quantity;
            $pharmacyMedicine->price = $request->price; // Update price only
            $pharmacyMedicine->status = $request->status ?? 'pending'; // Update status
        } else {
            // Create new record
            $pharmacyMedicine = new PharmacyMedicine();
            $pharmacyMedicine->pharmacy_id = $pharmacy->id;
            $pharmacyMedicine->medicine_id = $request->medicine_id;
            $pharmacyMedicine->medicine_name = $medicine->name;
            $pharmacyMedicine->quantity = $request->quantity;
            $pharmacyMedicine->price = $request->price;
            $pharmacyMedicine->sold = $request->sold;
            $pharmacyMedicine->status = $request->status ?? 'pending'; // Set status to pending if not provided
        }

        $pharmacyMedicine->save();

        return redirect()->route('pharmacies.medicines', ['pharmacy' => $pharmacy->id])
                         ->with('success', 'Medicine added successfully.');
    }
}


