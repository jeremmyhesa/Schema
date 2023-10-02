<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function login() {
        return view('auth.register', [
            'title' => 'Register|Schema',
            'active' => 'register'
        ]);
    }

    public function store (request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'username' => ['required', 'unique:users', 'min:5', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255'],
            

        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        

        return redirect('auth/login')->with('success', 'Registration Success, Login Now');
    }
}
