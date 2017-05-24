@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-12">
            <br>
            <div class="col-sm-5 pull-right bg-success">
                <b>Quantity of items in cart: 
                @if(\Session::has('cart_count')) 
                    {{Session::get('cart_count')}}
                @else
                    0
                @endif 
                </b>
                <span class="pull-right">
                    <a href="/viewcart"><button class="btn btn-success">view cart</button></a>&nbsp&nbsp&nbsp
                    <a href="/clearcart"><button class="btn btn-danger">clear cart</button></a>
                </span>
            </div>
            <br><br>
        </div>
        <div class="row well">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="well col-sm-12">
                    <h3><b>{{$product->name}}</b><h4>
                    <h5><b>{{$product->price}}</b></h5>
                    <form method="post" action="/addtocart/{{ $product->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-success" value="Add to cart">
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
