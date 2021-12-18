<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    public function show(Request $request) {
        if($request->user()->id != 1){
            return response()->json([
                'message' => 'you are not admin'
            ], 403);
        }
        return response()->json(User::where('id', '>', 1)->get(), 200);
    }

    public function profile(Request $request) {
        return response()->json(
            User::where('id', $request->user()->id)->get(),
         200);
    }    

    public function sendResetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'alternative_email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 403);
        }
        $user = User::where('email', $request->email)->first();        
        $alternative_email = $user->alternative_email;
        if(!$user || $alternative_email != $request->alternative_email){
            return response()->json([                
                'message' => 'user does not exist'
            ], 403);
        }
        
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Str::random(60)
        ]);
        

        $data = array(
            'email' => $user->email,
            'alternative_email' => $alternative_email,
            'name' => $user->name,
            'url' => 'reset-password'
        );

        $email = $request->alternative_email;
        
        Mail::send('emailResetPassword', $data, function ($message) use($email) {
            $message->to($email, 'no-reply')
            ->subject("NBLC reset password");                          
        });

        if(Mail::failures()){
            return response()->json([
                'message' => 'send email failed'
            ], 403);
        }

        return response()->json([
            'message' => 'email sent successfully'
        ], 200);
    }    

    public function resetPassword(Request $request, $token){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 403);
        }

        $user = DB::table('password_resets')->where('token', '=', $token)->first();
        
        if(!$user){
            return response()->json([
                'message' => 'token not found'
            ], 403);
        }        
        
        if($request->password == $request->confirm_password){
            $update = User::where('email', $user->email)->update([
                'password' => Hash::make($request->password)
            ]);            
        }        
        
        DB::table('password_resets')->where('token', '=', $token)->delete();

        return response()->json([
            'status' => true,
            'message' => 'password updated'
        ], 200);
    }    

    // public function updateAlternativeEmail(Request $request, $id){
    //     $validator = Validator::make($request->all(), [
    //         'alternative_email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $validator->errors()
    //         ], 403);            
    //     }
        
    //     $user = User::findOrFail($id);
    //     if($user->password == $request->password){
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'password wrong'
    //         ], 403);            
    //     }

    //     $user->alternative_email = $request->alternative_email;
    //     $user->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'alternative email updated'
    //     ], 200);    
    // }

    public function updateProfile(Request $request){    
        $id = $request->user()->id;
        $validator = Validator::make($request->all(), [
            'alternative_email' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'newPassword' => 'nullable|min:8'
        ]);   

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 403);
        }

        $user = User::findOrFail($id);
        if (!\Hash::check($request->oldPassword, $user->password)) {
            return response()->json([
                'message' => [
                    'password' => [
                        'Password Wrong'
                    ]                
                ]                    
            ], 403);
        }

        $password = '';
        
        if($request->newPassword && $request->confirmPassword){
            if($request->newPassword == $request->confirmPassword){                
                $password = Hash::make($request->newPassword);
            }else{
                return response()->json([
                    'message' => [
                        'confirmPassword' => [
                            'Password does not match'
                        ]
                    ]
                ], 403);
            }
        }

        if($password != ''){
            $user->password = $password;
        }        

        $user->email = $request->email;
        $user->alternative_email = $request->alternative_email;
        $user->save();

        return response()->json($user, 200);
    }

    public function store(Request $request) {        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'alternative_email' => 'required',
            'password' => 'required|min:8'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alternative_email' => $request->alternative_email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user, 200);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id            
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }

        
        $user->name = $request->name;
        $user->email = $request->email;                
        $user->save();

        return response()->json($user, 200);
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return response()->json([
            'message' => 'delete success',            
        ], 200);
    }
}
