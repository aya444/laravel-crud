<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


interface AuthService
{
    public function createUser(array $date): void;
    public function loginUser(array $credentials, Request $request): bool|ValidationException;
    public function logoutUser(Request $request): void;
}
