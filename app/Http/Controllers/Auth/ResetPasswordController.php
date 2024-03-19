<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    public function showResetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        return view('auth.reset-password',compact('token', 'email'));
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'reset_token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && ($user->remember_token == $request->reset_token)) {
            $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => null, 
            ]);
    
            return redirect()->route('login')->with('message', 'Password has been reset successfully!');
        }
    
        return back()->withErrors(['email' => 'Invalid token or email']);
    }
    
    
}
