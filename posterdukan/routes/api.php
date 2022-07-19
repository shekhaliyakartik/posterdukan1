<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login','UserController@login');
Route::post('/register','UserController@register');
Route::get('/getCategory','CategoryController@getAllCategory');
Route::post('/addCategory','CategoryController@addCategory');
Route::post('updateCategory/{id}', 'CategoryController@EditCategory');
Route::post('deleteCategory/{id}', 'CategoryController@DeleteCategory');
Route::get('/getNative','NativeController@getAllNativeLanguage');
Route::get('/getCountry','CountryController@getAllCountryList');
Route::get('/getState','StateController@getAllStateList');
Route::get('/getCity','CityController@getAllCityList');
Route::post('/addNativeLanguage','NativeController@addNativeLanguage');
Route::post('/addCountry','CountryController@addCountry');
Route::post('/addState','StateController@addState');
Route::post('/addCity','CityController@addCity');
Route::post('/editLanguage/{id}','NativeController@EditNativeLanguage');
Route::post('deleteLanguage/{id}', 'NativeController@DeleteNativeLanguage');


