<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ];


        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()], 400);
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'usario creado correctamente',
            'token' => $user->createToken('Api_Token')->plainTextToken,
        ], 200);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()], 400);
        }

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['status' => false,
            'errors' => ['No autorizado'],
            'email'=>$request->email,
            'password'=>$request->password
            ], 401);
        }
        $user = User::where('email',$request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'usario logueado correctamente',
            'data'=>$user,
            'token' => $user->createToken('Api_Token')->plainTextToken,
        ],200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'cerrada sesión correctamente',
        ],200);


    }
}
