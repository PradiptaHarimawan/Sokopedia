@extends('admin.adminBase')
@section('title','List Product')




@section('content')
<h1 style="text-align: center">Product</h1>
<!-- Tabel -->
<div style="width: 1000px; margin: 0 auto">
<table class="table table-bordered table-striped">
<thead class="thead-dark">
  <tr>
    <th scope="col">Product ID</th>
    <th scope="col">Product Image</th>
    <th scope="col">Product Name</th>
    <th scope="col">Product Category</th>
    <th scope="col">Product Price</th>
    <th scope="col">Product Description</th>
    <th scope="col">ACTION</th>
  </tr>
</thead>
<tbody>
    {{-- MENAMPILKAN DATA ITEM --}}
    {{-- Memasukan Kode Untuk Menampilkan Data --}}

  @foreach ($categories as $c)   
  @foreach ($c->products as $p)
    <tr>
      
      <td>{{$p->id}}</td>
      <td><img src="{{asset('storage/images/'. $p->image)}}" alt="" style="width: 150px" height="100px"></td>
      <td>{{$p->product_name}}</td>
      <td>{{$c->name}}</td>
      <td>{{$p->price}}</td>
      <td>{{$p->desc}}</td> 
      <td>
          <form action="listproduct/{{$p->id}}" method="POST">
              @method('delete')
              @csrf
            <button class="btn btn-danger" type="submit">DELETE</button>
          </form>
          
      </td>
    </tr>
    @endforeach
  @endforeach 
</tbody>
</table>
</div>
@endsection
