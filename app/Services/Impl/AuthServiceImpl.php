<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\AuthService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthServiceImpl implements AuthService
{
    public function createUser(array $data): void
    {
        $user = User::create($data);

        Auth::login($user); // use the Authentication facade to handle the rest of the work (logging the user and creating the session cookie)
    }

    public function loginUser(array $credentials, Request $request): bool|ValidationException
    {
        if (Auth::attempt($credentials)) // attempt to login the user based on a set of credentials
        {
            $request->session()->regenerate();
            return true;
        }
        
        throw ValidationException::withMessages([
            'credentials' => ['The provided credentials are incorrect.']
        ]);

    }
    public function logoutUser(Request $request): void
    {
        Auth::logout(); // removes only the user data from the session

        // $request->session()->invalidate(); // removes all data associated with that session

        $request->session()->regenerateToken(); // any data that gets submited using the previous token will be rejected. (Good practice for security)
    }

}
