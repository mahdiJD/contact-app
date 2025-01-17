<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title','Content App')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand text-uppercase" href="{{route('home.dashboard')}}">
            <strong>Contact</strong> App
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse" id="navbar-toggler">
            <ul class="navbar-nav">
                @if(Auth::check())
                <li class="nav-item"><a href="{{route('companies.index')}}" class="nav-link">Companies</a></li>
                <li class="nav-item active"><a href="{{route('contacts.index')}}" class="nav-link">Contacts</a></li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">

                @if(!Auth::check()) {{--@guest()--}}
                <li class="nav-item mr-2"><a href="{{route('login')}}" class="btn btn-outline-secondary">Login</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="btn btn-outline-primary">Register</a></li>
                @else
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route("user-profile-information.edit")}}">Profile</a>
                        <form action="{{ route('logout') }}" method="POST"
                              style="display: inline">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- --}}
@yield('content')

<script src= "{{asset('/js/jquery.min.js')}}"></script>
<script src="{{asset('/js/popper.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
@stack('scrips')
@if($message = session('status'))
    <script>
        swal("Creat successfully","{{$message}}","success")
    </script>
@endif

@if($message = session('message'))
    <script>
        swal("Creat successfully","{{$message}}","success")
    </script>
@endif

<script>
    function askForTrash(e , message){
        e.preventDefault();
        let form = e.currentTarget;
        swal({
            title:"Are you sure?",
            text: message,
            icon:"warning",
            buttons:true,
            dangerMode:true,
        })
            .then((willDelete)=>{
                if (willDelete) {
                    form.submit();
                }else {
                    swal("The Operation has been canceled!");
                }
            });
    }
</script>
</body>
</html>
