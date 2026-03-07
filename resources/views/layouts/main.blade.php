<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}">-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Real-auto</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('main.index') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ad.index') }}">Ads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about.index') }}">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Contacts
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Email</a>
                                <a class="dropdown-item" href="#">WhatsApp</a>
                                <a class="dropdown-item" href="#">Telegram</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('ad.create') }}">Create ad</a>
                        </li>
                    </ul>
                </div>
            </nav>
{{--            <nav>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('main.index') }}">main</a></li>--}}
{{--                    <li><a href="{{ route('ad.index') }}">ads</a></li>--}}
{{--                    <li><a href="{{ route('about.index') }}">about</a></li>--}}
{{--                    <li><a href="{{ route('user.index') }}">users</a></li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
        </div>
        @yield('content')
    </div>
</body>
</html>
