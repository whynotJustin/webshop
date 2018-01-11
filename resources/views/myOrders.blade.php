@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <?php
                        $dbController = new \App\Http\Controllers\databaseController();
                        $orders = $dbController->getOrders();
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
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