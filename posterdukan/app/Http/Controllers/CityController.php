<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\City;

class CityController extends Controller
{
    public function getAllCityList(){
        $category = City::all();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Get Category"],200);
    }

    public function addCity(Request $request)
    {
       $CityName = $request->get('name');
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
                'name' => $CityName,
                'icon' => $imageName,
                 'total_population'=>$total_population,
                 'use_population'=>$use_population,
                 'status' => $request->get('status')
             );
             City::insert($record);
            return Response::json(['data'=>$record,'success'=>true,"message"=>"Succesfully Add Country"],200);
        }
        
    }
}
