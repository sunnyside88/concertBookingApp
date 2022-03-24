<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Concert Fiver</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <!-- Styles -->
</head>

<body class="antialiased">
    <div class="row justify-content-center ">
        @if (Route::has('login'))
        <div class="card-header d-flex">
            <div class="me-auto p-2">
                <h2 style="padding-left:10px">GoLive <img
                        src="https://img.icons8.com/external-royyan-wijaya-detailed-outline-royyan-wijaya/24/000000/external-disc-music-royyan-wijaya-detailed-outline-royyan-wijaya.png" />
                </h2>
            </div>
            <div class="p-2">
                @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500">Home</a>
                @else
                <a href="{{ route('login') }}" style="padding:10px;text-decoration: none;"
                    class="text-md text-gray-700 dark:text-gray-500">Log in</a>
                @if (Route::has('register'))
                <button type="button" class="btn btn-primary "><a style="color:white;text-decoration: none;"
                        href="{{ route('register') }}">Register</a>
                </button>
                @endif
                @endauth
            </div>
        </div>

        @endif
        <div style=" padding:10px; max-width:600px; max-height:300px !important;">
            <div id="carousel"></div>

        </div>

    </div>

</body>
<script src="/js/app.js"></script>

</html>