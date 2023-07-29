<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(){
        $order=Order::all();
        return view('admin.pages.orders.list',compact('order'));
    }

    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="paid";
        $order->save();
        return redirect()->back();

    }
}
