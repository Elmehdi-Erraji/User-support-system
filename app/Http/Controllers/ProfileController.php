<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();        
        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
    
            $user = User::findOrFail($id);
            
        
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');

            if ($request->hasFile('avatar')) {
                if ($user->getFirstMedia('avatars')) {
                    $user->clearMediaCollection('avatars');
                }
                $user->addMediaFromRequest('avatar')->toMediaCollection('avatars', 'avatars');
            }

            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

   
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

   
}
