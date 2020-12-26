@extends('userBase')
@section('title','Home')

@section('content')

<div style="margin: 0 auto; margin-top: 70px; text-align: center">
    @foreach ($products as $p)
    <div class="card" style="width: 18rem; display: inline-flex; margin-inline: 25px">
        <img src="{{asset('storage/images/'. $p->image)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 style="height: 45px; text-align: left; overflow: hidden;" class="card-title">{{$p->product_name}}</h5>
            <p style="text-align: left" class="card-text">IDR. {{$p->price}}</p>
            <a href="{{url('product_detail/'. $p->id)}}" class="btn btn-success">Product Detail</a>
        </div>
     </div>    
    @endforeach
</div>

<div style="position: absolute; left: 50%; margin-top: 75px; transform:translate(-50%, -50%)">
    {{$products->withQueryString()->links()}}
</div>



@endsection