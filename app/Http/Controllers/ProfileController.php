<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Password updated successfully');
    }

   
}
