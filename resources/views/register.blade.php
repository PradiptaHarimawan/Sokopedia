@extends('userBase')
@section('title','Register')
    
@section('content')
    <div style="width: 1000px; text-align:center; margin: 0 auto">    
        <form action="" method="POST">
            @csrf
            <h2 style="text-align: center">Register</h2>
            <div class="form-group">
                <label for="userName">Username</label>
                <input type="text" class="form-control" id="userName" placeholder="Username" name="name">

                <label for="emailAddress">Email Address</label>
                <input type="text" class="form-control" id="emailAddress" placeholder="Email Address" name="email">

                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" placeholder="Password" name="password">

                <label for="confPass">Confirm Password</label>
                <input type="password" class="form-control" id="confPass" placeholder="Confirm Password" name="confirmation_password">
            </div>


            <button type="submit" style="width: 225px;" class="btn btn-primary">Register</button>
        </form>

        @if ($errors->any())
            {{$errors->first()}}
        @endif
    </div>
@endsection