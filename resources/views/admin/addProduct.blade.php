@extends('admin.adminBase')
@section('title','Add Product Page')

@section('content')

<div style="width: 1000px; text-align:center; margin: 0 auto">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 style="text-align: center">Add Product</h2>
        <div class="form-group">
            <label for="ProductName">Name</label>
            <input type="text" class="form-control" id="ProductName" placeholder="Product Name" name="name">
        </div>
    
        <div class="form-group">
                <label for="type">Product Category</label> <br>
                <select id="type" class="form-control" name="category">
                <option value="">Product Category</option>
                @foreach ($categories as $c)
                    <option value="{{$c->id}}"> {{$c->name}} </option>
                @endforeach
                </select>
        </div>
        
        <div class="form-group">
            <label for="ProductDesc">Description</label> <br>
            <textarea class="form-control" id="ProductDesc" rows="3" cols="68" name="desc" placeholder="Product Description"></textarea>
        </div>
    
        <div class="form-group" >
            <label for="ProductPrice">Price</label>
            <input type="number" class="form-control" id="ProductPrice" name="price" placeholder="Product Price">
        </div>
    
        <div class="form-group" >
            <label for="ProductImage">Choose Image</label>
            <input type="file" class="form-control-file" id="ProductImage" name="image" style="margin-left:400px;">
        </div>
    
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
    @if ($errors->any())
        {{$errors->first()}}
    @endif
</div>
@endsection
