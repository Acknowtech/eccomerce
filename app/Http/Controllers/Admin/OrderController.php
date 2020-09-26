<?php

namespace App\Http\Controllers\Admin;

use App\CouponCode;
use App\Http\Controllers\Controller;

use App\Order;
Use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        abort_unless(\Gate::allows('view_order'), 403);
        $orders = Order::with(['couponDetails','customer','deliveryBoy'])->orderBy('id','DESC')->get();

        return view('admin.orders.index', compact('orders'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        abort_unless(\Gate::allows('view_order'), 403);
        $delivery_boy_list = User::whereHas('roles',function ($role){
            $role->where('title','=','delivery_boy');
        })->get();
        $order = Order::where('id',$id)->with(['couponDetails','customer','orderDetails','orderStatus','address','deliveryBoy','orderDetails.customProductDetails','orderDetails.customProductDetails.ingradient'])->first();

        return view('admin.orders.show', compact(['order','delivery_boy_list']));
    }

    public function assignDeliveryBoy(Request $request, $id){
        abort_unless(\Gate::allows('assign_delivery_boy'), 403);
        $delivery_boy_list = User::whereHas('roles',function ($role){
            $role->where('title','=','delivery_boy');
        })->get();
        $order = Order::where('id',$id)->with(['couponDetails','customer','orderDetails','orderStatus','address','deliveryBoy'])->first();
        $order->delivery_boy_id=$request->delivery_boy_id;
        $order->order_status_id=3;
        $order->save();
        return view('admin.orders.show', compact(['order','delivery_boy_list']));

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {


    }


    public function destroy($id)
    {
        //
    }
}
