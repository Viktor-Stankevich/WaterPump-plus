<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registration
     */
    public function registration(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->only('name', 'password')))
        {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'name' => ['Некоректный логин']
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
    }

}
