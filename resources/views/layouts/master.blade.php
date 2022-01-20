<html lang="en">

<head>
    <title>ICO Trends - @yield('title')</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('scripts')
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    @section('header')
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand p-0 g-0 b-0" href="/">
                    <div class="d-flex g-0 p-0 b-0">
                        {{-- <img class="d-inline-block align-self-center logo-image g-0 p-0 b-0" alt="ICO Trends" src="{{ asset('images/favicon.svg') }}"> --}}
                        <div class="align-self-center ps-1 g-0 p-0 b-0">
                            UK ICO Security Incident Trends
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        {{-- This is where we would have a register button if we needed to register users, but we dont because it's not that much  --}}
                        {{-- --}}
                        <li class="nav-item active">
                            <a class="nav-link" href="/about">Source</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/application-programming">API</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/privacy">Privacy Policy</a>
                        </li>
                    </ul>
                    {{-- More buttons we don't need  --}}
                    {{-- --}}
                    {{-- <div class="d-flex px-md-1">
                        <div class="col-xs-6">
                            <a href="/register" class="nav-link">Sign Up</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="/register" class="nav-link">Sign Up</a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </nav>
    </header>
    @show
    @yield('content')
</body>

@section('footer')
<footer>
    <!-- Thanks for reading. -->
    Footer goes here.
</footer>
@show

</html>