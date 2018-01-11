@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    We have this much screens in inventory:
                        <br>
                    <!--you can order screens here:
                        <form action="{{asset('PHP/Order.php')}}" METHOD="post">
                            <input type="number0" name="quantity">
                            <button type="submit">Order</button>
                        </form>-->

                        <?php
                        $dbController = new \App\Http\Controllers\databaseController();
                        $stock = $dbController->getStock();
                        echo $stock;
                        ?>
                        <br>
                        <br>
                        <form method="POST" action="{{url('/handleOrder')}}">
                            amount: <input type="number" name="amount">
                            <input type="hidden" name="userId" value="{{Auth::id()}}">
                            <input type="hidden" name="productId" value="1">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit">Order</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
