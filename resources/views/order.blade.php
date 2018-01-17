@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">
                        @include("includes.alerts")
                        <h3 class="text-center">order</h3>
                        <hr>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @php
                            $dbController = new \App\Http\Controllers\databaseController();
                            $products = $dbController->getProducts();
                            $counter = 1;
                            $size = "col-md-6";
                        @endphp
                        <div class="row">
                            @foreach($products as $product)
                                @if($counter == count($products) && $counter % 2 == 1)
                                    @php
                                        $size = "col-md-12";
                                    @endphp
                                @endif
                                @include("includes.card")

                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
