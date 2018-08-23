<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Doraly Reports</title>

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('jquery-ui-1.12.1.custom/jquery-ui.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <!-- javascript -->

    <script type="text/javascript" src="/js/canvasjs.js"></script>
    <script type="text/javascript" src="/js/raports.js"></script>

    <script type="text/javascript" src="/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <script type="text/javascript" src="/jquery-ui-1.12.1.custom/jquery-ui.js"></script>

    @extends('tools.datepicker')

</head>
<body>


    <div id="app">

        @extends('tools.menu')

        @yield('content')

        @extends('tools.footer')

    </div>


</body>
</html>
