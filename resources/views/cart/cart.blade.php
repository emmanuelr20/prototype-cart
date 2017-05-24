@extends('layouts.app')
@section('content')
<div class="container">
    @if (!\Session::get('cart'))
            <h3><b>NOT ITEM IN CART YET!</b></h3>
    @else
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
                <div class="col-sm-12">
                    <a href="/removeitem/{{ $item['name']}}"><button class="btn btn-danger">Remove from cart</button></a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
