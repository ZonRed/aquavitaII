<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register()
    {
        return view('admin.register');
    }

    public function simpanuser(Request $request)
    {
        // Debugging: log the request data
        \Log::info('Request data: ', $request->all());
    
        $existingUser = User::where('email', $request->email)->orWhere('nama', $request->nama)->first();
    
        if ($existingUser) {
            // Debugging: log the existing user
            \Log::info('Existing user found: ', $existingUser->toArray());
    
            return response()->json(['error' => 'Email atau nama sudah ada'], 422);
        }
    
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    
        return redirect('/register');
    }
    


    public function login()
    {
        return view('admin.login');
    }

    public function checklogin(Request $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json(['error' => 'Email atau password salah'], 401);
        } else {
            return response()->json(['success' => 'Login successful']);
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
