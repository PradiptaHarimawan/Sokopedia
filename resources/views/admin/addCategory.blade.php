@extends('admin.adminBase')
@section('title','Add Category Page')

@section('content')
<div style="width: 1000px; text-align:center; margin:0 auto">
    <form action="" method="POST">
        @csrf
        <h2 style="text-align: center">Add Category</h2>
        <div class="form-group">
            <label for="categoryName">Name</label>
            <input type="text" class="form-control" id="categoryName" placeholder="Category Name" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
    @if ($errors->any())
        {{$errors->first()}}
    @endif
</div>
@endsection
