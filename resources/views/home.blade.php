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
<<<<<<< HEAD
                    We have this much glass in inventory:
                    <br>
                    <br>
                    <br>
                    you can order glass here:
                        <form action="{{asset('PHP/Order.php')}}" METHOD="post">
                            <input type="number0" name="quantity">
                            <button type="submit">Order</button>
                        </form>
=======

                    You are logged in! <?php
                        $dbController = new \App\Http\Controllers\databaseController();
                        $dbController->getStock()?>
                        <a href="{{ url('/order') }}">order</a>
>>>>>>> 66ff161d1e9edd3d6a87b161a206b4fcf36cd776
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
