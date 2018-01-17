<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;
use App\Order;
use App\Product;

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

    public function getStock($id)
    {
        $sql = "SELECT stock FROM products WHERE id = $id";
        $stock = $this->runQuery($sql);
        return $stock["stock"];
    }

    public function getPrice($id)
    {
        $sql = "SELECT price FROM products WHERE id = $id";
        $price = $this->runQuery($sql);
        return $price["price"];
    }

    public function makeOrder(Request $orderDetail)
    {
        $productId = $orderDetail['productId'];
        if($orderDetail["amount"] <= $this->getStock($productId)) {


            $order = Order::create([
                'order_date' => date("Y-m-d H:i:s"),
                'quantity' => $orderDetail['amount'],
                'total_price' => $orderDetail['amount'] * $this->getPrice($productId),
                'user_id' => $orderDetail['userId'],
                'product_id' => $productId,
            ]);
            $order->save();

            $newStock = $this->getStock($productId) - $orderDetail["amount"];
            $updateOrder = Product::find($orderDetail['productId']);
            $updateOrder->stock = $newStock;
            $updateOrder->save();

            return redirect("order")->with("success", "your order has been completed, view your orders in the my orders tab");
        } else {
            return redirect("order")->with("error", "We don't have enough screens in stock, your order was not completed");
        }

    }

    public function getOrders()
    {
        $userID = Auth::id();
        $order = Order::where('user_id', $userID)->get();
        return $order;
    }

    public function getProducts(){
        $products = Product::get();
        return $products;
    }
}
