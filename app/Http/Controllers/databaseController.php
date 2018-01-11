<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class databaseController extends Controller
{

    private function getConnection(){
        $dbPassword = config('DB_PASSWORD');
        $dbUserName = config('DB_USERNAME');
        $connection = new PDO("mysql:host=127.0.0.1;dbname=xoutof10glass;", "root","root");
        return $connection;
    }

    private function runQuery($sql)
    {
        $connection = $this->getConnection();
//        $stmt = $connection->prepare($sql);
//        $stmt->execute($args);
        $result = $connection->query($sql)->fetch();
        return $result;
    }

    public function getStock(){
        $sql = "SELECT stock FROM products WHERE id = 1";
        $stock = $this->runQuery($sql);
        return $stock["stock"];
    }

    public function getPrice(){
        $sql = "SELECT price FROM products WHERE id = 1";
        $price = $this->runQuery($sql);
        return $price["price"];
    }

    public function getOrders(){
        $userID = Auth::id();
        $sql = "SELECT order_date quantity total_price FROM orders WHERE user_id = $userID"
        $orders = this->runQuery($sql);
        return $orders;
    }
}
