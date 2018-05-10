<?php

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
//
Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', 'CategoryController');

Route::resource('businesses', 'BusinessController');

Route::get('businesses/{business}/review', 'BusinessController@review')->name('review');

Route::resource('information', 'InformationController');

Route::resource('admins', 'AdminController')/*->middleware('role:admin.index')*/;

Route::get('login', 'SessionsController@create')->name('login');

Route::post('login', 'SessionsController@store')->name('login');

Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::post('admins/{admin}/add_pass', 'AdminController@add_pass')->name('add_pass');

Route::resource('activities', 'ActivityController');

Route::get('orders_today','OrderController@today')->name('today');

Route::resource('permissions', 'PermissionController');

Route::resource('roles', 'RoleController');

Route::get('food_today','Order_goodsController@food_today')->name('food_today');

Route::resource('users', 'UserController');

Route::resource('menus', 'MenuController');

Route::resource('events', 'EventsController');

Route::resource('event_prize', 'EventPrizeController');

Route::resource('event_members', 'Event_memberController');

Route::get('events/{event}/lottery','EventsController@lottery')->name('lottery');

Route::get('events/{event}/winning','EventsController@winning')->name('winning');

//测试中文分词搜索
//Route::get('/search',function (){
////    require ( "sphinxapi.php" );
//    $cl = new \App\SphinxClient();
//    $cl->SetServer ( '127.0.0.1', 9312);
////$cl->SetServer ( '10.6.0.6', 9312);
////$cl->SetServer ( '10.6.0.22', 9312);
////$cl->SetServer ( '10.8.8.2', 9312);
//    $cl->SetConnectTimeout ( 10 );
//    $cl->SetArrayResult ( true );
//// $cl->SetMatchMode ( SPH_MATCH_ANY);
//    $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
//    $cl->SetLimits(0, 1000);//返回多少条数据
//    $info = '胖哥烧烤';
//    $res = $cl->Query($info, 'information');//shopstore_search
////print_r($cl);
////    print_r($res);
//    if ($res['total']){
//        //获取商家id
//       $datas =  collect($res['matches'])->pluck('id');
//       dd($datas);
//    }else{
//
//    }
//
//});
//Route::get('/mail',function(){
//    \Illuminate\Support\Facades\Mail::send(
//        'mail',//邮件视图模板
//        ['name'=>'张三'],
//        function ($message){
//            $message->to('1839652639@qq.com')->subject('订单确认');
//        }
//    );
//    return '邮件发送成功';
//});