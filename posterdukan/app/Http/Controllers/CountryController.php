<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\Country;

class CountryController extends Controller
{
    public function getAllCountryList(){
        $category = Country::all();
        return Response::json(['data'=>$category,'success'=>true,"message"=>"Get Country List"],200);
    }

    public function addCountry(Request $request)
    {
       $CountryName = $request->get('name');
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
                'name' => $CountryName,
                'icon' => $imageName,
                 'total_population'=>$total_population,
                 'use_population'=>$use_population,
                 'status' => $request->get('status')
             );
             Country::insert($record);
            return Response::json(['data'=>$record,'success'=>true,"message"=>"Succesfully Add Country"],200);
        }
        
    }
}
