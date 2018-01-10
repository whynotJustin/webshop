<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class databaseController extends Controller
{

    private function getConnection(){
        $dsn = "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_DATABASE"];
        $dbPassword = $_ENV["DB_PASSWORD"];
        $dbUserName = $_ENV["DB_USERNAME"];
        $connection = new PDO($dsn, $dbUserName, $dbPassword);
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

    public function addOrder(Request $orderDetail){

    }
}
