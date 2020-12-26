@extends('userBase')
@section('title','Add to Cart')


@section('content')

    @if ($products)
    <div class="container" style="margin-top: 75px">
        <div class="row">
          <div class="col">
            <img style="width: 350px" src="{{asset('storage/images/'. $products->image)}}" alt="">
          </div>
          <div class="col" style="background-color: darkgrey;">
              <form action="" method="POST">
                @csrf
                <label style="margin-left: 25px; margin-top: 25px; font-size: 35px;">{{$products->product_name}}</label> <br>
                <h3 style="display: inline-block; margin-left: 25px; margin-top: 10px">Price: </h3> <label style="font-size: 45px; color: green" >IDR.{{$products->price}}</label>  <br>
                <p style="margin-left: 25px; margin-top: 10px; text-align: left; font-size: 20px;">Description: {{$products->desc}}</p>
                <div style="margin-left: 25px; margin-top: 10px; text-align: left;">
                  <label for="ProductQty">Quantity</label>
                  <input type="number" id="ProductQty" name="qty" style="width: 75px" placeholder="0">
                </div>
                <input type="hidden" name="productid" value="{{ $products->id }}">
                <button type="submit" class="btn btn-primary">Add to Cart</button>
              </form>
              
              

              
          </div>
        </div>



    @endif






@endsection
