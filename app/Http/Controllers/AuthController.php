<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

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
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

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
