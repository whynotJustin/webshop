@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h3 class="text-center">My orders</h3>
                        <hr>
                        <?php
                        $dbController = new \App\Http\Controllers\databaseController();
                        $orders = $dbController->getOrders();
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Order date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($orders as $order) {?>
                            <tr>
                                <td>
                                    <?php
                                    $products = \App\Product::where('id', $order['product_id'])->get();
                                    foreach ($products as $product) {
                                        echo $product['product_name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $order['quantity'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $order['total_price'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $order['order_date'];
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection