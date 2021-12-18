<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Validator;

class AboutController extends Controller
{
    public function show(){
        $news = News::whereIn('id', [1,2,3])->get();
        $news = $news->map(function ($item, $key) {
            $titlePath = preg_replace('/[^a-zA-Z0-9 ]/', " ", $item->title);
            $titlePath = preg_replace('/ /', "-", $titlePath);
            return [
                'id' => $item->id,
                'title' => trim($item->title),
                'image' => $item->image,
                'content' => $item->content,
                'path' => strtolower($titlePath),
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json($news, 200);
    }

    public function detail($title){
        $newTitle = preg_replace('/\-/', "%", '%'.$title.'%');
        $content = News::where('title', 'like', $newTitle)->with('user')->get();        
        $content = $content->filter(function($item, $key) use ($title) {
            $titlePath = preg_replace('/[^a-zA-Z0-9 ]/', " ", $item->title);
            $titlePath = preg_replace('/ /', "-", $titlePath);
            return $title == strtolower($titlePath);
        });
        return response()->json($content, 200);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [            
            'content' => 'required|min:100'            
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
                'content' => $request->content
            ], 403);
        }

        $news = News::findOrFail($id);                        
        $news->content = $request->content;               
        $news->save();
        return response()->json($news, 200);
    }
}
