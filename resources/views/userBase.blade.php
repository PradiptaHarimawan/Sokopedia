<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>@yield('title')</title>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <a class="navbar-brand text-success" href="{{url('home/')}}">$okopedia</a>
        <form class="form-inline my-2 my-lg-0" action="/product/search" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" value="{{Request::input('search')}}" style="width: 600px">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        
    </ul>
    </div>
    <ul class="navbar-nav mr-auto justify-content-end">
        @if($auth)
        <li class="nav-item mr-2">
            <a class="nav-link btn btn-success" href="{{url('/cart')}}" style="color: white">Cart <span class="badge badge-light"> {{count((array) session('cart'))}} </span> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-success" href="{{url('/history')}}" style="color: white">History</a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth()->User()->username}}</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                @if ($auth && Auth()->User()->role == 'admin')
                <a class="dropdown-item" href="{{url('/admin')}}">Admin Panel</a>
                @endif
            </div>

        </li>

        @else
        <li class="nav-item">
            <a class="nav-link" href="{{url('/login')}}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/register')}}">Register</a>
        </li>
        @endif
    </ul>
</nav>



    <div class="main">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>