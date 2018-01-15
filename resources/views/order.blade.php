@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row inner-box">
                            <h3 class="text-center">order</h3>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @php
                                $dbController = new \App\Http\Controllers\databaseController();
                                $products = $dbController->getProducts();
                            @endphp
                            <div class="product-container">
                                @foreach($products as $product)
                                    <div class="card col-xs-12">
                                        <div class="text-center">
                                            <img src="{{$product['image_location']}}"
                                                 alt="{{$product['product_name']}}" class="image">
                                            <h3>{{$product['product_name']}}</h3>
                                            <p>{{$product['description']}}</p>
                                            <h5>price: €{{$product['price']}}</h5>
                                            <form method="POST" action="{{url('/handleOrder')}}" class="inner-box">
                                                <input type="hidden" name="userId" value="{{Auth::id()}}">
                                                <input type="hidden" name="productId" value={{$product['id']}}>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="row" style="margin-left: 0.5vw; margin-right: 1vw">
                                                    <div class="form-group col-xs-8" style="float: left">
                                                        <input type="number" name="amount" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary col-xs-4" type="submit"
                                                            style="float: right;">Order
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
