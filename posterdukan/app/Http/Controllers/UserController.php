<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Response;
use App\Models\User;
use DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function login(Request $request){
           $email = $request->get('email');
           $password = $request->get('password');
           $user = DB::table('user')->where('email',$email)->first();
            $validator = Validator::make($request->all(), [ 
                'email' => 'required|email',
                'password' => 'required',
            ]);
      
        if ($validator->fails()) {
            return Response::json(['error'=>$validator->errors()->first(),'success'=>false,],200);

        }else{
           if($email == $user->email && $password == $user->password){
                return Response::json(['data'=>$user,'success'=>true,"message"=>"Succesfully Login"],200);

            }else{
                return Response::json(['error'=>"invalid credentials",'success'=>false,"message"=>"Invalid Creditals"],200);

            }
        }
     }  
   
     public function register(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'mobile' => 'required',
            'role' => 'required',
        ]);
        $ip = "'".$request->ip()."'";
        // $ip = '50.90.0.1';
        $currentUserInfo = \Location::get($ip);
     
        
        $lat= $currentUserInfo->latitude; //latitude
        $lng= $currentUserInfo->longitude; //longitude
        $request->file('photo')->store('images');
       
     if ($validator->fails()) {
         return Response::json(['error'=>$validator->errors()->first(),'success'=>false,],200);

     }else{ 
        if ($request->hasFile('photo'))
        {
       //      $imageName = time().'.'.$request->image->extension();  
    
       //  $request->image->move(public_path('images'), $imageName);
            $name = $request->file('photo')->getClientOriginalName();
            $imageName = time().'.'.$request->photo->extension();  
     
            $request->photo->move('images', $imageName);
            // $path = $request->file('photo')->store('avatars', 'public');
       }

        $user = array(
            'email' => $email,
            'password'=>$password,
            'country'=>$currentUserInfo->countryName,
            'state' =>$currentUserInfo->countryCode,
            'city' => $currentUserInfo->cityName,
            'mobile'=>$request->mobile,
            'role_id'=>$request->role,
            'photo' => $imageName,
            'location' => $currentUserInfo->cityName,
            'latitude' => $lat,
            'longitude' => $lng
    );
        DB::table('user')->insert($user);
        return Response::json(['data'=>$user,'success'=>true,"message"=>"Succesfully Register"],200);
     }
  }  
}
