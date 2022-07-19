<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Native;

class NativeController extends Controller
{
    public function getAllNativeLanguage(){
        $category = Native::all();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Get Category"],200);
    }

    public function addNativeLanguage(Request $request)
    {
       $categoryName = $request->get('name');
       $total_population = $request->get('total_population');
       $use_population = $request->get('use_population');
       $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            // 'icon' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return Response::json(['error'=>$validator->errors()->first(),'success'=>false,],200);
   
        }else{ 
            $imageName = '';
            if ($request->hasFile('icon'))
            {
         
                $name = $request->file('icon')->getClientOriginalName();
                $imageName = time().'.'.$request->icon->extension();  
                $request->icon->move('icons', $imageName);
              
           }
           $record = array(
                'name' => $categoryName,
                'icon' => $imageName,
                 'total_population'=>$total_population,
                 'use_population'=>$use_population,
                 'status' => $request->get('status')
             );
             Native::insert($record);
             return Response::json(['data'=>$record,'success'=>true,"message"=>"Succesfully Add Native Language"],200);
        }
    }

    public function EditNativeLanguage(Request $request,$id){
       
        $Name = $request->get('name');
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return Response::json(['error'=>$validator->errors()->first(),'success'=>false,],200);
   
        }else{ 
            
        $category = Native::where('id','=',$id) ->update([
            'name' => $name
         ]);;
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Update Native Language"],200);

        }
    }

    public function DeleteNativeLanguage(Request $request,$id){
        $category = Native::where('id', $id)->delete();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Delete Language"],200);

    }
    public function getNLanguageById(Request $request)
    {
        $category = Native::find($request->id);
        return Response::json(['data'=>$category,'success'=>true,"message"=>"get By id Category"],200);
    }
    
}
