<?php

namespace App\Http\Controllers;

use App\Models\User;

class MedicineManagementController extends Controller
{
    public function index()
    {
        $users = User::where('role', 2)->get(); // Fetch users with role=2
        return view('admin.medicines', compact('users'));
    }
}
