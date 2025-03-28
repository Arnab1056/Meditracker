<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pharmacy; // Ensure this line is present
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 2) { // Check if the user is a medicine maker
                return redirect()->route('medicines.index');
            } elseif ($user->role == 3) { // Check if the user is a regular user
                return redirect()->route('pharmacies.index');
            } elseif ($user->role == 4) { // Check if the user is a regular user
                return redirect()->route('searchpage');
            }
            elseif ($user->role == 1) { // Check if the user is a regular user
                return redirect()->route('admin.page');
            }
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer|in:1,2,3,4',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($user->role == 3) {
            // Add values to the pharmacies table
            Pharmacy::create([
                'name' => $user->name,
                'location' => null,
                'email' => $user->email,
                'phone' => null,
                'role' => 3,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); // Redirect to home page
    }
}
