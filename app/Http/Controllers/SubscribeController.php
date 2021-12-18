<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribe;
use Validator;

class SubscribeController extends Controller
{
    public function show(){
        return response()->json(Subscribe::all(), 200);        
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [            
            'email' => 'required|email|unique:users',            
        ]);
        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }
        Subscribe::create([
            'email' => $request->email
        ]);
        return response()->json([
            'message' => 'store success'
        ], 200);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [            
            'email' => 'required|email|unique:users,email,'.$id,            
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }
        $subscribe = Subscribe::findOrFail($id);
        $subscribe->email = $request->email;
        $subscribe->save();
        return response()->json([
            'message' => 'update success'
        ], 200);
    }

    public function destroy($id){
        Subscribe::findOrFail($id)->delete();
        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
