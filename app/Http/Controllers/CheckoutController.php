<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index() {
        return view('checkout.index');
    }

    public function addOrder(Request $request)
    {
        $order = new Order;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->zipcode = $request->zipcode;
        $order->city = $request->city;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->save();
        return view('checkout.success');
    }
}
