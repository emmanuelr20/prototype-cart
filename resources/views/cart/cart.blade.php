@extends('layouts.app')
@section('content')
<div class="container">
    @if (!\Session::get('cart'))
            <h3><b>NO ITEM IN CART YET!</b></h3>
    @else
        <div class="col-sm-12 well">
            <div class="bg-primary col-sm-12" style="border-radius: 10px">
                <h4><b>Receipt</b></h4>
                @foreach (\Session::get('cart') as $item)
                    <p><h5>{{ $item['name']}}: &nbsp&nbsp&nbsp<b class="text-danger">{{ $item['qty']}}</b></h5></p>
                @endforeach
                <h3><b>Total: </b>#{{\Session::get('cart_amount')}}</h3>
                <a href=""><button class="btn btn-success pull-right"type="">Checkout</button></a><br><br>
            </div>
        <div><br><br><br><br><br><br><br><hr>
        @foreach (\Session::get('cart') as $item)
            <div class="col-sm-12 well">
                <div class="col-sm-12">
                    <h3>name: <b>{{ $item['name']}}</b></h3>
                    <h5>price per item: {{ $item['price']}}</h5>
                </div>
                <form method="post" action="/updateqty/{{ $item['name']}}">
                    {{ csrf_field() }}
                    <div class="col-sm-3"><input type="number" class="form-control" name="qty" value="{{$item['qty']}}"/></div>
                    <input type="submit" class="btn btn-primary" value="update quantity">
                </form><br>
                <div class="col-sm-3">
                    <form method="post" action="/removeitem/{{ $item['name']}}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger" value="Remove from cart">
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
