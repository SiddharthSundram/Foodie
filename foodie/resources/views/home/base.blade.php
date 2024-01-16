<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
          
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

        <style>
            .wow{
                box-shadow: 3px 3px 5px #aaaaaa; 
                box-sizing: border-box;
            }
            .wow:hover{
                box-shadow: 10px 8px 10px #aaaaaa; 
                cursor: pointer;
            }
         </style>
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a href="{{route('home')}}" class="navbar-brand">{{ env('APP_NAME') }}</a>

            <div class="navbar-nav nav">
                <a href="{{route('home')}}" class="nav-link nav-item">Home</a>

                @auth
                    <a href="" class="nav-link nav-item text-capitalize text-white">{{auth()->user()->name}}</a>
                    <a href="{{ route('myOrder') }}" class="nav-link nav-item">My Order</a>
                    <a href="{{ route('cart') }}" class="nav-link nav-item">Cart</a>
                    <a href="{{ route('logout') }}" class="nav-link nav-item">Logout</a>
                @endauth

                @guest
                    <a href="{{ route('signup') }}" class="nav-link nav-item">Create an account</a>
                    <a href="{{ route('login') }}" class="nav-link nav-item">Login</a>
                @endguest
            </div>
        </div>
    </div>

    
   



    @section('content')

    @show

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>

        toastr.options = {
            'closeButton' : true
        }
        @if(session('success'))
            toastr.success("<?= session('success') ?>")
        @endif
        @if(session('error'))
            toastr.error("<?= session('error') ?>")
        @endif
    </script>
</body>

</html>
