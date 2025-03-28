<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyManagementController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('admin.pharmacies', compact('pharmacies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->update($request->only(['name', 'location', 'phone']));

        return redirect()->route('admin.pharmacies')->with('success', 'Pharmacy updated successfully.');
    }

    public function destroy($id)
    {
        $pharmacy = Pharmacy::findOrFail($id);
        $pharmacy->delete();

        return redirect()->route('admin.pharmacies')->with('success', 'Pharmacy removed successfully.');
    }
}
