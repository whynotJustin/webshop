@extends('layouts.app')

@section('content')
    <?php
        $dbController = new \App\Http\Controllers\databaseController();
        $orders = $dbController->getOrders();
        foreach($orders as $order){
            echo $order['total_price'];
    }
    ?>
@endsection