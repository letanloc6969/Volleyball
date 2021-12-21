<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->orderBy('orders.id','desc')->paginate(5);
        return view('admin.order.index',compact('orders'));
    }

    public function confirm($id)
    {
        $orders = Order::find($id);
        $order_product = DB::table('orders')
            ->join('order_products','orders.id','=','order_products.order_id')
            ->join('product_sizes','order_products.productsize_id','=','product_sizes.id')
            ->join('sizes','product_sizes.size_id','=','sizes.id')
            ->join('products','product_sizes.product_id','=','products.id')
            ->select('orders.*','order_products.*','product_sizes.*','sizes.*','products.*')->get();
//        dd($order_product);
        return view('admin.order.confirm',compact('orders','order_product'));
    }

    public function update(Request $request,$id)
    {

        $a= Order::find($id)->update([
            'status' => $request->status
        ]);
        return redirect()->route('orders.index');
    }

    public function search(Request $request)
    {
        $keyWords = $request->order_search;
        $search_order = Order::where('name','like','%' . $keyWords . '%')->orWhere('status','like','%' . $keyWords . '%')
            ->orWhere('created_at','like','%' . $keyWords . '%')->orWhere('payments','like','%' . $keyWords . '%')
            ->orWhere('id','like','%' . $keyWords . '%')->orWhere('user_id','like','%' . $keyWords . '%')
            ->orWhere('total','like','%' . $keyWords . '%')->get();
        return view('admin.order.search',compact('search_order'));
    }
}
