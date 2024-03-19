<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function RegistrationForm()
    {
        return view('auth.register');
    }


    public function register(RegistrationRequest $request)
    {
        // dd($request);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->email,
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);
        
        $role = Role::find(3);

        $user->roles()->sync([$role->id]);
        return redirect()->route('login')->with('success', 'Successfully registered');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest  $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Successfully logged in');
        } else {
            return redirect()->back()->with('message', 'Invalid Credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Successfully logged out');
    }
}
