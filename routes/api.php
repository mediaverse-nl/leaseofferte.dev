<?php

use Illuminate\Http\Request;

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


Route::get('/calculator-rates-{id}', 'Api\CalculatorController@get');
Route::get('/text-editor-1', 'Api\TextEditorController@show');
Route::post('/text-editor-{id}', 'Api\TextEditorController@edit');
Route::get('/lease-calculator', 'Api\LeaseCalculatorController@show');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


