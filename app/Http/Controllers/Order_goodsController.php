<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order_goodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }

    public function food_today()
    {

        $rows = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('information','orders.shop_id','=','information.id')
            ->select('information.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('information.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->get();
//        dd($rows);
        foreach ($rows as $row){
            echo '总计'.':'.'<br>'.$row->shop_name.':'.$row->goods_name.':'.'订单数量'.':'.$row->amounts;
        }
        echo '<br/>';
        $start = date('Y-m-01');
        $end = date('Y-m-t 23:59:59');
        $shop_id = Auth::user()->information_id;
        $months = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('information','orders.shop_id','=','information.id')
            ->select('information.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('information.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->where([
                ['orders.order_birth_time','>=',$start],
                ['orders.order_birth_time','<=',$end],
                ['orders.shop_id',$shop_id]
            ])->get();
        foreach ($months as $month){
            echo '这月'.':'.'<br>'.$month->shop_name.':'.$month->goods_name.':'.'订单数量'.':'.$month->amounts;
        }
        echo '<br/>';
        $start_today = date('Y-m-d');
        $end_today = date('Y-m-d 23:59:59');
//        var_dump($start_today,$end_today);die;
        $todays = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('information','orders.shop_id','=','information.id')
            ->select('information.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('information.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->where([
                ['orders.order_birth_time','>=',$start_today],
                ['orders.order_birth_time','<=',$end_today],
                ['orders.shop_id',$shop_id]
            ])->get();
        foreach ($todays as $today){
            echo '今天'.':'.'<br>'.$today->shop_name.':'.$today->goods_name.':'.'订单数量'.':'.$today->amounts;
        }
//        dd($todays,$months);
    }
}
