<html lang="en">

<head>
    <title>ICO Trends - @yield('title')</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('scripts')
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" sizes="any" type="image/svg+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div id="page-container">
        @section('header')
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
                <div class="container-fluid">
                    <a class="navbar-brand p-0 g-0 b-0" href="/">
                        <div class="d-flex g-0 p-0 b-0">
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

                            <li class="nav-item active">
                                <a class="nav-link" href="/about">About</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="https://github.com/aidancrane/ico-security-trends">Source Code <span class="mdi mdi-launch"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        @show
        <main class="flex-fill text-main">
            @yield('content')
        </main>
    </div>
</body>

@section('footer')
<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div>
                    <span class="text-muted"><span class="mdi mdi-bookmark-box-multiple"></span> Contains public sector information licensed under the Open Government Licence v3.0</span>
                </div>
                <div>
                    <span class="text-muted"><span class="mdi mdi-web"></span> Maintained by <i><a href="https://infinityflame.co.uk">Aidan Crane</a></i> and contributors</span>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <span class="text-muted"><span class="mdi mdi-progress-check"></span> Version <b>{{ env('ICO_VERSION', '1.0.0') }}</b></span>
                </div>
                <div>
                    <span class="text-muted"><span class="mdi mdi-cached"></span> Cached at <b>{{ time() }}</b></span>
                </div>
            </div>
        </div>
    </div>
</footer>
@show

</html>