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
Route::any('/shop/selectGD','Api\shopping@selectGD');
Route::any('/shop/addGD','Api\shopping@addGD');
Route::any('/shop/updGD','Api\shopping@updGD');
Route::any('/shop/selectGN','Api\shopping@selectGN');
Route::any('/shop/goodsPurchase','Api\shopping@goodsPurchase');
Route::any('/shop/revokePurchase','Api\shopping@revokePurchase');
Route::any('/shop/browsePicture','Api\shopping@browsePicture');
Route::any('/shop/selectBrowse','Api\shopping@selectBrowse');
Route::any('/shop/detailedPicture','Api\shopping@detailedPicture');
Route::any('/shop/selectDetailed','Api\shopping@selectDetailed');
Route::any('/shop/carouselInfo','Api\shopping@carouselInfo');
Route::any('/shop/carouselUpload','Api\shopping@carouselUpload');
Route::any('/shop/selectOD','Api\shopping@selectOD');
Route::any('/shop/selectShipping','Api\shopping@selectShipping');
Route::any('/shop/ordersGoods','Api\shopping@ordersGoods');
Route::any('/shop/deliverGoods','Api\shopping@deliverGoods');
Route::any('/shop/cancelOrders','Api\shopping@cancelOrders');
Route::any('/shop/refundTrue','Api\shopping@refundTrue');
Route::any('/shop/refundFalse','Api\shopping@refundFalse');
Route::any('/shop/searchDetailed','Api\shopping@searchDetailed');
Route::any('/shop/userInfo','Api\shopping@userInfo');
Route::any('/shop/addMoney','Api\shopping@addMoney');
Route::any('/shop/updatePW','Api\shopping@updatePW');
Route::any('/shop/updatePay','Api\shopping@updatePay');
Route::any('/shop/receiveAddress','Api\shopping@receiveAddress');
Route::any('/shop/addAddress','Api\shopping@addAddress');
Route::any('/shop/updateAddress','Api\shopping@updateAddress');
Route::any('/shop/deteleAddress','Api\shopping@deteleAddress');
Route::any('/shop/defaultAddress','Api\shopping@defaultAddress');
Route::any('/shop/shopcarInfo','Api\shopping@shopcarInfo');
Route::any('/shop/shopcarSel','Api\shopping@shopcarSel');
Route::any('/shop/shopcarNum','Api\shopping@shopcarNum');
Route::any('/shop/shopcarDel','Api\shopping@shopcarDel');
Route::any('/shop/shopcarAdd','Api\shopping@shopcarAdd');
Route::any('/shop/submitOrders','Api\shopping@submitOrders');