<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $user->save();
        } catch (\Exception $e) {
            return back()->with('error', 'Check your credentials and try again');
        }

        return redirect()->route('login')->with( 'message','Registration succesfull!');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $userName = $user->name;

                return redirect('/home')->with('userName', $userName);
            } else {
                throw new \Exception('Check your credentials and try again');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('message', 'You have been logged out!');
    }
}