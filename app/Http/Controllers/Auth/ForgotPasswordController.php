<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Email not found')->withErrors(['email' => 'Email not found']);
        }

        $email = $user->email;
        $token = Str::random(60);

        if ($user->remember_token) {
            $user->update(['remember_token' => null]);
        }

        $user->remember_token = $token;
        $user->save();

        
    
        Mail::to($user->email)->send(new ResetPassword($token, $email));
    
        return redirect()->back()->with('success', 'Password reset link sent to your email');
    }
}
