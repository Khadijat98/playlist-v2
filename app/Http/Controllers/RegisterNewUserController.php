<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterNewUserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|max:255'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user->createToken('auth_token')->plainTextToken;
    }
}
