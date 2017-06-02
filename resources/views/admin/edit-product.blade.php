@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-sm-12">
        <a href="{{ route('admin_product') }}" class="btn btn-primary pull-right">Products</a><br>
        <hr>
        <form method="post" action="/admin/edit/{{$product->id}}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="col-sm-12">
                <img src="{{$product->img}}" class="thumbnail col-sm-6">
            </div>
            <br>
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" value="{{$product->name}}" name="name" placeholder="product name..." required class="form-control"> 
            </div><br>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" value="{{$product->price}}" name="price" placeholder="product price..." required class="form-control"> 
            </div><br>
            <div class="form-group">
                <input type="file" name="image" placeholder="product name..."  value="{{$product->img}}" class="form-control btn btn-primary"> 
            </div>
            <input type="submit" class="btn btn-success col-sm-12" value="save">
        </form>
        <br><br><br><br>
    </div>
</div>
@endsection
