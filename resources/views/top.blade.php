<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel='stylesheet' href='/assets/css/bootstrap.min.css' />
        <script type='text/javascript' src="assets/js/jquery-3.6.0.min.js" ></script>
        @yield('head')
    </head>
    <body class="{{$body_class_name}}">
        <div class="col-lg-8 mx-auto p-3 py-md-5">
            
            @yield('content')
            @include('footer')
        </div>
    </body>
</html>
