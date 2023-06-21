<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password' => Hah::make($request->input('password')),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'usario creado correctamente',
            'token' => $user->createToken('Api_Token')->plainTextToken,
        ], 200);
    }

    public function ingresar(Request $request)
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
            'errors' => ['No autorizado']
            ], 401);
        }
        $user = User::where('email',$request->email)->first();
        return response()->json([
            'status' => true,
            'message' => 'usario creado correctamente',
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
