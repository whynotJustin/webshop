<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;

class OrderController extends Controller
{
    private $dbController;

    function __construct()
    {
        $this->dbController = new databaseController();
    }

    public function HandleOrder(Request $orderDetail){
        $order = Order::create([
            'order_date' => date("Y-m-d H:i:s"),
            'quantity' => $orderDetail['amount'],
            'total_price' => $orderDetail['amount'] * $this->dbController->getPrice(),
            'user_id' => $orderDetail['userId'],
            'product_id' => $orderDetail['productId'],
        ]);
        $order->save();
        return view("handleOrder");
    }
}
