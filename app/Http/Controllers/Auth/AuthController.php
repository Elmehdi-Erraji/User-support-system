<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */



    public function register(Request $request)
    {
        // Validate request data
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed'],
        ]);

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 0, // Default status
        ]);

        $role = Role::find(4); // Assuming 4 is the ID of the default role

        // Attach the default role to the user
        $user->roles()->sync([$role->id]);


        // Return a success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt',$token, 60*24); //1day

        return response([
            'message' =>'loged in successfully'
        ])->withCookie($cookie);

    }

    public function user()
    {
        return 'ets ';
    }


    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response([
            'message' =>'loged out successfully'
        ])->withCookie($cookie);
    }
}
