<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Http;


class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6|confirmed',
            
        ]);

        User::create([
            
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

       
        // if ($response->successful()) {
        //     return redirect()->route('register.form')->with('success', 'Registration successful!');
        // }

        // $data = $response->json();

// Periksa apakah response memiliki key 'message'
        // $message = $data['message'] ?? 'Registration failed. Please try again.';
        return redirect()->route('register.form')->with('success', 'Registration successful!');

    }
}
