<div class="{{$size}}  col-xs-12 inner-box">
    <div class="text-center">
        <img src="{{$product['image_location']}}" alt="{{$product['product_name']}}" class="image">
        <h3>{{$product['product_name']}}</h3>
        <p>{{$product['description']}}</p>
        <h5>price: €{{$product['price']}}</h5>
        <form method="POST" action="{{url('/handleOrder')}}">
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