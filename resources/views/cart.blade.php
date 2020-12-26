@extends('userBase')
{{-- Referensi yang digunakan: https://webmobtuts.com/backend-development/creating-a-shopping-cart-with-laravel/ --}}
@section('content')
    <?php $total = 0 ?>
    @if(session('cart'))
    <div style="margin-left: 100px; margin-top:20px;">
        @foreach(session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity'] ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/images/'. $details['photo'] ) }}" width="100px" height="200px" class="card-img img-responsive"/>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $details['name'] }}</h5>
                            <p class="card-text">Product Price: IDR.{{ $details['price'] }}</p>
                            <form action="{{url('cart/edit/'.$id)}}" method="POST">
                                @csrf
                                <label>Quantity: <input type="number" id="ProductQty" name="qty" style="width: 75px" value="{{$details['quantity']}}"></label>
                                <p>Subtotal: IDR.{{ $details['price'] * $details['quantity'] }}</p>
                                {{-- <p class="card-text"><small class="text-muted">Quantity: {{ $details['quantity'] }}</small></p> --}}
                                <span>
                                    <a href="{{url('/cart/delete/'.$id)}}" class="btn btn-danger" data-id="{{ $id }}">DELETE</a>
                                    {{-- <a href="{{url('/cart/edit/'.$id.$details['quantity'])}}" class="btn btn-success" data-id="{{ $id }}">EDIT</a> --}}
                                    <input type="submit" class="btn btn-success" value="EDIT">
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <span>
            <p><strong>Total IDR. {{ $total }}</strong></p>
            <a href="{{ url('/process') }}" class="btn btn-danger" style="margin-top: 5px;"><i class="fa fa-angle-left"></i> Checkout</a>
        </span>
        </div>

        @else
        <h1 style="text-align: center; margin-top: 25px">YOUR CART IS EMPTY :(</h1>

    @endif
@endsection

