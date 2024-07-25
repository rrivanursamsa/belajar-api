<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        if (!Auth()->attempt($request->only('email','password'))) {

            return response()->json([
                'status' => false,
                'massage' => 'Gagal Login',
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'status' => 'true',
            'data' => $user,
            'access_token' => $token,
            'massage' => 'Login success',
        ], 200);
    }

     public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'massage' => 'logout success',
        ], 200);
     }

     public function register(Request $request)
     {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'data' => $user,
            'success' => true,
            'massage' => 'user berhasil dibuat',
        ]);
     }
}
