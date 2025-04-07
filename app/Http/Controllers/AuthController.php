<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

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

        $this->authService->createUser($validated);

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

        try {
            $this->authService->loginUser($validated, $request);
            return redirect()->route('products.index')->with('success', 'User Logged In Successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }


    /**
     * Logout the user in.
     */
    public function logout(Request $request)
    {
        $this->authService->logoutUser($request);

        return redirect()->route('welcome')->with('success', 'User Logged Out Successfully.');
    }
}
