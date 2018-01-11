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
                        @php
                        $screenQuantity = 200;
                        echo $screenQuantity;
                        @endphp
                    <br>
                        <br>
                    you can order screens here:
                        <form action="{{asset('PHP/Order.php')}}" METHOD="post">
                            <input type="number0" name="quantity">
                            <button type="submit">Order</button>
                        </form>

                        <!--<?php
                        $dbController = new \App\Http\Controllers\databaseController();
                        $dbController->getStock()?>
                        <a href="{{ url('/order') }}">order</a>-->

                        $stock = $dbController->getStock()
                        echo $stock["stock"];
                        ?>
                        <a href="{{ url('/order') }}">order</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
