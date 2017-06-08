<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Github battle">
    <meta name="author" content="Tverdokhlib Kyrylo">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Github-battle</title>

    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/my-style.css')}}" rel="stylesheet">
    <link href="{{asset('css/fake-loader.css')}}" rel="stylesheet">
    <link href="{{asset('css/jqueryDataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<div class="container">

    <div class="content">
        @include('layouts.navbar')

        @yield('content')

        <div class="fakeloader"></div>
    </div>

    @include('layouts.footer')


</div>


<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('js/my-ajax.js')}}"></script>
<script src="{{asset('js/my-js.js')}}"></script>
<script src="{{asset('js/fake-loader.min.js')}}"></script>
<script src="{{asset('js/jqueryDataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

</body>
</html>