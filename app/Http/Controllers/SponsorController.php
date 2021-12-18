<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use Validator;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function show(){
        return response()->json([
            Sponsor::all()
        ], 200);
    }

    public function getPosition(){
        $position = Sponsor::select('position')->get();        
        $tempPosition = collect([
            [
                'position' => 'header',                
                'limit' => 3
            ],
            [
                'position' => 'carousel',                
                'limit' => 4
            ],
            [
                'position' => 'content',                
                'limit' => 6
            ],
            [
                'position' => 'all',                
                'limit' => 0
            ]
        ]);                

        $tempPosition = $tempPosition->map(function($value) use($position){                        
            return [
                'position' => $value['position'],
                'total' => count($position->where('position', $value['position'])),
                'limit' => $value['limit']
            ];            
        });

        return response()->json($tempPosition, 200);
    }

    private function confirmPosition($position){
        $sponsor = Sponsor::where('position', $position)->get();
        if($position == 'header' && $sponsor->count() >= 3){
            return false;
        }
        
        if($position == 'carousel' && $sponsor->count() >= 4){
            return false;
        }

        if($position == 'content' && $sponsor->count() >= 6){
            return false;
        }        

        return true;
    }
    
    public function store(Request $request){       
        $validator = Validator::make($request->all(), [
            'brand' => 'required|unique:sponsors',
            'link' => 'required',
            'position' => 'required',
            'imageFile' => 'image|mimes:jpg,png,jpeg,svg|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }                
        
        if(!$this->confirmPosition($request->position)){
            return response()->json([
                "status" => false,
                "message" => [
                    "position" => [
                        'position is full'
                    ]
                ]
            ], 403);
        };


        $image = '';

        if($request->imageFile){
            $request->file('imageFile')->store('image', 'public');
            $image = '/storage/image/'.$request->imageFile->hashName();
        }        

        if($request->imageURL){
            $image = $request->imageURL;
        }

        if($image == ''){
            return response()->json([
                'status' => false,
                'message' => [
                    'image' => ['image is required']
                ]

            ], 403);
        }

        $sponsor = Sponsor::create([
            'position' => $request->position,
            'brand' => $request->brand,
            'link' => $request->link,   
            'image' => $image
        ]);        

        return response()->json([
            $sponsor
        ], 200);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'brand' => 'required|min:5|unique:sponsors,brand,'.$id,
            'link' => 'required',
            'position' => 'required',
            'imageFile' => 'image|mimes:jpg,png,jpeg,svg|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }        

        $sponsor = Sponsor::findOrFail($id);
        if($sponsor->position != $request->position){
            if(!$this->confirmPosition($request->position)){            
                return response()->json([
                    "status" => false,
                    "message" => [
                        "position" => [
                            'position is full'
                        ]
                    ]
                ], 403);
            };
            $sponsor->position = $request->position;
        }        

        $image = '';        

        if($request->imageFile){
            Storage::disk('local')->delete('public/image/'.$sponsor->image);
            $request->file('imageFile')->store('image', 'public');
            $image = '/storage/image/'.$request->imageFile->hashName();
        }        

        if($request->imageURL){
            $image = $request->imageURL;
        }        

        $sponsor->brand = $request->brand;

        if($image != ''){
            $sponsor->image = $image;
        }

        $sponsor->link = $request->link;        
        $sponsor->save();
        return response()->json([
            $sponsor
        ], 200);
    }

    public function destroy($id){
        $sponsor = Sponsor::findOrFail($id);
        Storage::disk('local')->delete('public/image/'.$sponsor->image);
        $sponsor->delete();
        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
