@extends('admin.adminBase')
@section('title','List Category')

@section('content')
<h1 style="text-align: center">Category</h1>

<div style="text-align: center; " class="list-group">
  @foreach ($categories as $c)
    <a href="../../admin/listcategory/{{$c->id}}" class="list-group-item list-group-item-action">{{$c->name}}</a>    
  @endforeach
</div>
<br>
@if ($products != null)
<div style="width: 1000px;margin: 0 auto">
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Product Id</th>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Price</th>
        <th scope="col">Product Description</th>
      </tr>
    </thead>
    <tbody> 
      @foreach ($products->products as $p)
        <tr>
          <td>{{$p->id}}</td>
          <td><img src="{{asset('storage/images/'. $p->image)}}" alt="" style="width: 150px" height="100px"></td>
          <td>{{$p->product_name}}</td>
          <td>{{$p->price}}</td>
          <td>{{$p->desc}}</td>
        </tr>
      @endforeach 
    </tbody>
  </table>
</div>
@endif
@endsection




