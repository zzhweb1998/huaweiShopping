<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/shop/user','Api\shopping@User');
Route::any('/shop/login','Api\shopping@Login');
Route::any('/shop/register','Api\shopping@Register');