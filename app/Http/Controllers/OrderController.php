<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/categories
     *  to get all categories
     */
    public function index(Request $request)
    {
        try {
            $categories = Order::all();
            return response()->json([
                "success" => true,
                "data" => $categories,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  POST api/categories
     *  to create a new order
     */
    public function store(Request $request)
    {
        try {
            $order = new Order();
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->total = $request->total;
            $order->note = $request->note;
            // $order->user_id = Auth::user()->id;
            $order->user_id = 1;
            $order->save();
            foreach ($request->products as $product) {
                $newOrder = Order::find($order->id);
                $newOrder->products()->attach($product['id'], [
                    "total" => $request['total'],
                    "solo_price" => $product['price'],
                    "size" => $product['size'],
                    "color" => $product['color'],
                    "quantity" => $product['quantity'],
                ]);
            }
            return response()->json([
                "success" => true,
                "data" => $order,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
