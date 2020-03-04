<?php

Route::get('/calculator-rates-{id}', 'Api\CalculatorController@get');
Route::get('/text-editor-1', 'Api\TextEditorController@show');
Route::post('/text-editor-{id}', 'Api\TextEditorController@edit')->middleware('isAdmin');
Route::get('/lease-calculator', 'Api\LeaseCalculatorController@show');
