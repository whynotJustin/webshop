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
                        <form method="POST" action="{{url('/handleOrder')}}">
                            amount: <input type="number" name="amount">
                            <input type="hidden" name="userId" value="{{Auth::id()}}">
                            <input type="hidden" name="productId" value="1">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="button" type="submit">Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
