<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginUserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|max:255'
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        if (Hash::check($validated['password'], $user->password)) {
            return $user->createToken('auth_token')->plainTextToken;
        }

        return response()->json(['error'=> 'Not authorised'], 403);
    }
}
