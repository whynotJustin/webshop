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
                    We have this much glass in inventory:
                    <br>
                    <br>
                    <br>
                    you can order glass here:
                        <form action="{{asset('PHP/Order.php')}}" METHOD="post">
                            <input type="number0" name="quantity">
                            <button type="submit">Order</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
