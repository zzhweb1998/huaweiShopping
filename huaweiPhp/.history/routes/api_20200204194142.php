<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/shop/user','Api\shopping@User');
Route::any('/shop/login','Api\shopping@Login');
Route::any('/shop/register','Api\shopping@Register');
Route::any('/shop/goodsInfo','Api\shopping@goodsInfo');
Route::any('/shop/ordersDetailed','Api\shopping@ordersDetailed');
Route::any('/shop/purchaseInfo','Api\shopping@purchaseInfo');
Route::any('/shop/goodsDetailed','Api\shopping@goodsDetailed');
Route::any('/shop/updateUser','Api\shopping@updateUser');
Route::any('/shop/delUser','Api\shopping@delUser');
Route::any('/shop/goodsAdd','Api\shopping@goodsAdd');
Route::any('/shop/goodsUpd','Api\shopping@goodsUpd');
