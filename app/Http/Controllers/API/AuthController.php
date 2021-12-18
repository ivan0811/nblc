<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 403);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }        

        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request){        
        $request->user()->currentAccessToken()->delete();
        return response()->json([            
            "status" => "success"
        ], 200);
    }    
}
