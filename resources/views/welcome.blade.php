<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Ways</title>
        <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.png">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css" type="text/css" />
        <link rel="stylesheet" href="{{ url('/') }}/css/app.css" type="text/css" />
        <script src="{{ url('/') }}/js/jquery.js"></script>
    </head>
    <body>
        <div id="page-view"> 
            <noscript>You need to enable JavaScript to run this app.</noscript>
            <div id="app"></div>
        </div>
        <script src="{{ url('/') }}/js/script.js"></script>
        <script src="{{ url('/') }}/js/app.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4vI5mOw08twg4G1UQ7xu76L-_ZYN4iME
&libraries=places&region=IN"></script>
    </body>
</html>
