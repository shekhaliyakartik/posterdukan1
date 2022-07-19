<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::view('login','login');
Route::view('/dashboard','pages/dashboard');
Route::get('/dashboard',function(){
    return view('dashboard');
});
Route::get('/category',function(){
    return view('pages/category');
});
Route::get('/nativelanguage',function(){
    return view('pages/nativelanguage');
});
Route::get('/city',function(){
    return view('pages/city');
});
Route::get('/country',function(){
    return view('pages/country');
});
Route::get('/state',function(){
    return view('pages/state');
});
Route::get('/getcategoryById','CategoryController@getCategoryById');
Route::get('/getcategoryById','NativeController@getNLanguageById');

