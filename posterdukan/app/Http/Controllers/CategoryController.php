<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use DB;
use App\Models\Category;

class CategoryController extends Controller
{

    public function getAllCategory(){
        $category = Category::all();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Get Category"],200);
    }
    public function addCategory(Request $request)
    {
       $categoryName = $request->get('categoryname');
       $validator = Validator::make($request->all(), [ 
            'categoryname' => 'required',
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
           $category = array(
                'categoryname' => $categoryName,
                'icon' => $imageName,
                'status' => $request->get('status')
             );
             Category::insert($category);
            return Response::json(['data'=>$category,'success'=>true,"message"=>"Succesfully Add Category"],200);
        }
        
    }

    public function EditCategory(Request $request,$id){
       
        $categoryName = $request->get('categoryname');
        $validator = Validator::make($request->all(), [ 
            'categoryname' => 'required',
        ]);
        if ($validator->fails()) {
            return Response::json(['error'=>$validator->errors()->first(),'success'=>false,],200);
   
        }else{ 
            
        $category = DB::table('category')->where('id','=',$id)->update(array('categoryname' => $categoryName));
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Update Category"],200);

        }
    }

    public function DeleteCategory(Request $request,$id){
        $category = Category::where('id', $id)->delete();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Delete Category"],200);

    }
    public function getCategoryById(Request $request)
    {
        $category = Category::find($request->id);
        return Response::json(['data'=>$category,'success'=>true,"message"=>"get By id Category"],200);
    }
}
