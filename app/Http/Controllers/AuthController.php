<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new user.
     */
    public function showRegister()
    {
        return view("auth.register");
    }

    /**
     * Create a new user.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // it should be unique within the user table
            'password' => 'required|string|min:6|confirmed', // it should be confirmed with the second password input, it automatically hashes the pass
        ]);

        $user = User::create($validated);

        Auth::login($user); // use the Authentication facade to handle the rest of the work (logging the user and creating the session cookie)

        return redirect()->route('products.index')->with('success', 'User Registered Successfully.');
    }

    /**
     * Show the form for logging in.
     */
    public function showLogin()
    {
        return view("auth.login");
    }


    /**
     * Log the user in.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($validated)) // attempt to login the user based on a set of credentials
        {
            $request->session()->regenerate();
            return redirect()->route('products.index')->with('success', 'User Logged In Successfully.');
        }
        
        throw ValidationException::withMessages([
            'credentials' => ['The provided credentials are incorrect.']
        ]);
    }


    /**
     * Logout the user in.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // removes only the user data from the session

        // $request->session()->invalidate(); // removes all data associated with that session

        $request->session()->regenerateToken(); // any data that gets submited using the previous token will be rejected. (Good practice for security)

        return redirect()->route('welcome')->with('success', 'User Logged Out Successfully.');
    }
}
