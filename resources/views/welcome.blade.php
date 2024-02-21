<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Online Test Exam</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1><a href="{{url('/')}}">Online Exam</a></h1>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li class="dropdown"><a href="#"><span>Exam Start</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li>
                            <a href="{{ route('register') }}">User Register</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>

@yield('content')

<script src="{{asset('frontend/assets/js/main.js')}}"></script>
</body>
</html>
