<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginform() {
        return view('authentication.login');
    }

    public function signupform() {
        return view('authentication.signup');
    }

    public function signup(Request $request) {
        $validator = Validator::make($request->all(), 
        [
            'username' => "required",
            'email'    => "required|email|unique:users",
            'password' => "required|min:8|confirmed",
        ], 
        [
            'required'  => 'Šis laukas yra privalomas',
            'email'     => 'Įveskite tinkamą el. paštą',
            'unique'    => 'Naudotojas su šiuo el. paštu jau egzistuoja',
            'min'       => 'Įveskite bent :min simbolius',
            'confirmed' => 'Slaptažodžiai nesutampa',
        ]);

        if ($validator->fails()) {
            return redirect("signup")
                        ->withErrors($validator)
                        ->withInput();
        }

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect("/login");
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Netinkamas el. paštas arba slaptažodis.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
