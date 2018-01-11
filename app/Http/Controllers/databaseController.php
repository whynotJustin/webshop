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

            return $order;
        } else {
            echo "stock is empty";
        }

    }

    public function getOrders()
    {
        $userID = Auth::id();
        $sql = "SELECT order_date quantity total_price FROM orders WHERE user_id = $userID";
        $orders = $this->runQuery($sql);
        return $orders;
    }
}
