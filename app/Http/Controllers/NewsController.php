<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Validator;
use Carbon\Carbon;

class NewsController extends Controller
{            
    public function show(Request $request){        
        $pagination = '';    
        $perPage = 0;                
        if($request->public_show === 'true'){                        
            $currentPage = (int)$request->page;
            $offset = 0;
            $limit = 7;
            $perPage = 7;            
            if($request->page == 2){
                $offset = 8;
                $limit = 6;
            }else if($request->page > 2){                                
                $offset = ($currentPage - 1) * 7;
                $perPage = 6;
                $limit = 6;
            }
            $news = News::whereNotIn('id', [1,2,3])->latest()->offset($offset)->limit($limit)->get();            
            $totalNews = News::whereNotIn('id', [1,2,3])->count();            
            $lastPage = $totalNews > 7 ? $totalNews / 7 : 1;            
            $to = $currentPage * 7;
            if($request->page == $lastPage) $to = $totalNews;            
            $pagination = [
                    'total' => $totalNews,
                    'per_page' => $perPage,
                    'current_page' => $currentPage,
                    'last_page' => $lastPage,
                    'from' => $offset,
                    'to' => $to
                ];
        }else {
            $news = News::whereNotIn('id', [1,2,3])->latest()->paginate(6);        
            $pagination = [
                    'total' => $news->total(),
                    'per_page' => $news->perPage(),
                    'current_page' => $news->currentPage(),
                    'last_page' => $news->lastPage(),
                    'from' => $news->firstItem(),
                    'to' => $news->lastItem()                
                ];
        }        
        
        $data = $news->sortBy([
            ['updated_at', 'desc']
        ]);        

        $data = $data->map(function ($item, $key) {
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
                'date' => Carbon::parse($item->updated_at)->format('F d, Y')
            ];
        });

        return response()->json([            
            'pagination' => $pagination,
            $data            
        ], 200);
    }  

    public function detail($title){                      
        $newTitle = preg_replace('/\-/', "%", '%'.$title.'%');
        $content = News::where('title', 'like', $newTitle)->with('user')->get();        
        $content = $content->filter(function($item, $key) use ($title) {
            $titlePath = preg_replace('/[^a-zA-Z0-9 ]/', " ", $item->title);
            $titlePath = preg_replace('/ /', "-", $titlePath);
            return $title == strtolower($titlePath);
        });
        return response()->json([            
            $content[0],
            'date' => Carbon::parse($content[0]->updated_at)->format('F d, Y')
        ], 200);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:news|min:36',            
            'content' => 'required|min:100',
            'imageFile' => 'image|mimes:jpg,png,jpeg,svg|max:10000'            
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }

        if($request->imageFile){
            $request->file('imageFile')->store('image', 'public');
            $image = '/storage/image/'.$request->imageFile->hashName();
        }        

        if($request->imageURL){
            $image = $request->imageURL;
        }

        $news = News::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
            'content' => $request->content,             
            'image' => $image
        ]);        

        return response()->json([
            $news            
        ], 200);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:36|unique:news,title,'.$id,            
            'content' => 'required|min:100',
            'imageFile' => 'image|mimes:jpg,png,jpeg,svg|max:10000'                     
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ], 403);
        }

        $news = News::findOrFail($id);

        $image = '';

        if($request->imageFile){
            Storage::disk('local')->delete('public/image/'.$news->image);
            $request->file('imageFile')->store('image', 'public');
            $image = '/storage/image/'.$request->imageFile->hashName();
        }        

        if($request->imageURL != "null" && $request->imageURL != null){
            $image = $request->imageURL;
        }
        
        $news->title = $request->title;
        $news->content = $request->content;        
        if($image != ''){
            $news->image = $image;
        }

        $news->save();
        return response()->json([
            $news            
        ], 200);
    }    

    public function destroy($id){
        $news = News::findOrFail($id);
        Storage::disk('local')->delete('public/image'.$news->image);
        $news->delete();
        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
