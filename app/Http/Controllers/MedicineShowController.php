<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineShowController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all(); // Fetch all medicines
        return view('admin.medicineshow', compact('medicines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'detail' => 'required|string',
            'selled' => 'required|integer',
            'quantity' => 'required|integer',
            'maker_name' => 'required|string|max:255',
            'maker_id' => 'required|string|max:255',
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->only(['name', 'date', 'detail', 'selled', 'quantity', 'maker_name', 'maker_id']));

        return redirect()->route('admin.medicines.show')->with('success', 'Medicine updated successfully.');
    }

    public function destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('admin.medicines.show')->with('success', 'Medicine removed successfully.');
    }
}
