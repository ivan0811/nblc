<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscribe;
use Illuminate\Support\Facades\DB;
use Validator;

class SendMailController extends Controller
{
    public function sendMail(Request $request){   
        $validator = Validator::make($request->all(), [
            'email_body' => 'required'            
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }    

        if($request->email_body == "<p></p>" || $request->email_body == "null"){
            return response()->json([
                "status" => false,
                "message" => [
                    "email_body" => [
                        "The message is required"
                    ]
                ]
            ], 403);
        }

        $subscribe = Subscribe::all();        
        DB::beginTransaction();
        foreach ($subscribe as $value) {
            $email = $value->email;
            $data = array(
                'email_body' => $request->email_body,                
            );
            
            Mail::send('emailBlast', $data, function ($message) use($email) {
                $message->to($email, 'no-reply')
                ->subject("NBLC Information");                          
            });
        }        
        DB::commit();        

        if(Mail::failures()){
            return response()->json([
                'message' => [
                    'email_body' => ['send email failed']
                ]
                    
            ], 403);
        }
        
        return response()->json([
            'message' => [
                'email_body' => [
                    'send email successfully'
                ]                
            ]
        ], 200);
    }
}
