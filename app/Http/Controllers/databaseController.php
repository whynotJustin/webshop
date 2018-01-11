<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;
use App\Order;
use App\Products;

class databaseController extends Controller
{

    private function getConnection()
    {
        $connection = new PDO("mysql:host=127.0.0.1;dbname=xoutof10glass;", "root", "root");
        return $connection;
    }

    private function runQuery($sql)
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    private function runQueryFetchAll($sql){
        $connection = $this->getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStock()
    {
        $sql = "SELECT stock FROM products WHERE id = 1";
        $stock = $this->runQuery($sql);
        return $stock["stock"];
    }

    public function getPrice()
    {
        $sql = "SELECT price FROM products WHERE id = 1";
        $price = $this->runQuery($sql);
        return $price["price"];
    }

    public function makeOrder(Request $orderDetail)
    {
        if($orderDetail["amount"] <= $this->getStock()) {

            $order = Order::create([
                'order_date' => date("Y-m-d H:i:s"),
                'quantity' => $orderDetail['amount'],
                'total_price' => $orderDetail['amount'] * $this->getPrice(),
                'user_id' => $orderDetail['userId'],
                'product_id' => $orderDetail['productId'],
            ]);
            $order->save();

            $newStock = $this->getStock() - $orderDetail["amount"];
            $updateOrder = Products::find($orderDetail['productId']);
            $updateOrder->stock = $newStock;
            $updateOrder->save();

            return view('orderCompleted');
        } else {
            return view('orderFailed');
        }

    }

    public function getOrders()
    {
        $userID = Auth::id();
        $order = Order::where('user_id', $userID)->get();
//        $sql = "SELECT order_date, quantity, total_price FROM orders WHERE user_id = $userID";
//        $orders = $this->runQueryFetchAll($sql);
        return $order;
    }
}
