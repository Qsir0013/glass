<?php
use think\Route;
// 后台路由
Route::rule('admin/login','admin/Login/index');
Route::rule('admin/index','admin/Index/index');
Route::rule('admin/out','admin/Login/singOut');
Route::rule('admin/index','admin/Index/index');
Route::rule('admin/cinfo','admin/Index/cinfo');

//api路由
Route::get('cate','api/Cate/rest');

Route::get('user','api/User/getOpenid');

Route::get('pro/:id','api/Pro/proList');
Route::get('pro','api/Pro/erro');

Route::get('address/:id','api/Address/addressList');
Route::post('address','api/Address/add');
Route::delete('address/:id','api/Address/delete');
Route::put('address/:id','api/Address/update');

Route::get('info/:id','api/Info/info');
Route::post('info','api/Info/userEdit');

Route::get('order/:id','api/Order/orderList');
Route::post('order','api/Order/add');
Route::delete('order/:id','api/Order/del');

Route::get('proinfo/:id','api/Proinfo/info');
Route::get('proinfo','api/Proinfo/erro');
Route::post('editinfo','api/Editinfo/userEdit');

Route::get('banner','api/Banner/bannerPro');

Route::get('shopcate/:id','api/Shopcate/shoppingList');
Route::post('shopcate','api/Shopcate/add');

Route::get('pay','api/Pay/index');
Route::get('callBack','api/Pay/callBack');

Route::post('refund','api/Refund/add');
Route::get('callBack','api/Pay/callBack');