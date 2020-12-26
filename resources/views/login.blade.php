@extends('userBase')
@section('title','Login')
    
@section('content')
    

    <h1 style="text-align: center">LOGIN</h1>

    <div style="margin: 0 auto; width: 1000px; text-align: center">
        <form method="POST" action="">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>

            <input style="width: 250px" class="btn btn-primary" type="submit" value="Login">
        </form>

        <div>
            @if ($errors->any())
            {{$errors->first()}}
            @endif
        </div>
        
        
    </div>
    
@endsection

</body>
</html>