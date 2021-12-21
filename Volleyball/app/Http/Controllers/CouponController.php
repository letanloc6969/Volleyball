<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{
    public function insert_coupon()
    {
        return view('admin.coupon.insert');
    }
    public function delete_coupon($coupon_id)
    {
        $coupon=Coupon::find($coupon_id);
        $coupon->delete();
        return Redirect::to('admin/list-coupon');
    }
    public function list_coupon()
    {
        $coupon = Coupon::orderby('coupon_id','DESC')->paginate(5);
        return view('admin.coupon.list')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon() ;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();

        return Redirect::to('admin/insert-coupon');
        //return redirect()->route('coupon.insert');
    }
}
