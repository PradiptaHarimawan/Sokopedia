@extends('userBase')

@section('title','History Detail')

@section('content')

@foreach ($detail as $d)
<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        
        <div class="col-md-4">
            <img src="{{ asset('storage/images/'. $d->products->image)}}" width="100px" height="200px" class="card-img img-responsive"/>
        </div> 
             
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$d->products->product_name}}</h5>                  
                <p class="card-text">Product Price: IDR. {{$d->total_price}}</p>
                <p class="card-text">Quantity: {{$d->qty}}</p>
            </div>
        </div>
    </div>
</div> 

@endforeach

@endsection