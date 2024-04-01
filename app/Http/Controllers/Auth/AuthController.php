<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserRegisterNotification;
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

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'admin'); 
        })->get();
        
        foreach ($admins as $admin) {
            $admin->notify(new UserRegisterNotification($user));
        }
        return redirect()->route('login')->with('success', 'Successfully registered');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

        public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->status == 1) {
                Auth::logout();
                return redirect()->route('login')->with('message', 'Wait for the admin approval.');
            } elseif ($user->status == 3) {
                Auth::logout();
                return redirect()->route('login')->with('message', 'Your account has been banned because: ' . $user->ban_reason);
            }

            $roleName = $user->roles()->first()->name; 
            switch ($roleName) {
                case 'admin':
                    return redirect()->route('dashboard')->with('success', 'Welcome to the Admin Dashboard!');
                case 'support_agent':
                    return redirect()->route('agent_ticket.index')->with('success', 'Welcome to the Support Agent Dashboard!');
                case 'client':
                    return redirect()->route('FaqHome')->with('success', 'Welcome !');
                default:
                    Auth::logout(); 
                    return redirect()->route('login')->with('message', 'Your role is not recognized.');
            }
        } else {
            return redirect()->back()->with('message', 'Invalid Credentials');
        }
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
