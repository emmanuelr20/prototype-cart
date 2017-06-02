@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-sm-12">
        <div class="col-sm-12 bg-primary" style="margin-top:10px">
                <h3 class=""><b>Admin product View</b></h3>
            </div>
        <div class="col-sm-12">
        <br>
            <form method="post" action="{{ route('addproduct')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" placeholder="product name..." required class="form-control"> 
                </div><br>
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="number" name="price" placeholder="product price..." required class="form-control"> 
                </div><br>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <input type="file" name="image" placeholder="product name..."  class="form-control btn btn-primary"> 
                    </div>
                    <input type="submit" class="btn btn-success pull-right" value="create product">
                </div>
            </form><hr>
        </div>
        <div class="row ">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="well col-sm-12">
                    <img src="{{$product->img}}" class="thumbnail col-sm-12" style="height:20em;">
                    <h3><b>{{$product->name}}</b><h4>
                    <h5><b>{{$product->price}}</b></h5>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <diV class="row">
                                    <a href="{{ route('editProductView', $product->id )}}">
                                        <button class="btn btn-primary">Edit Product</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <form method="post" action="{{ route('delete', $product->id) }}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-danger pull-right" value="Delete">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
