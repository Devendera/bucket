<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/page-validation.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>



    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
       <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .pull-right{
                margin-right:20px;
            }
        
</style>
</head>
<body>
<div class="container">
@if(Auth::user() != null)
  <p class="text-right p-10">
  <span class="pr-5">Hello  {{ Auth::user()->name }}</span> <span class="pr-5"><a href="{{ route('logout') }}">Sign Out</a></span>
</p>
  @endif

  <div style="display: inline-block;margin-left: 50px; margin-top:20px">
            <div class="pull-right">
               <button class="btn btn-success">
               <a class="btn btn-success" href="{{ route('bucket.index') }}">Buckets</a>
               </button>
            </div>
            <div class="pull-right">
               <button class="btn btn-success">
               <a class="btn btn-success" href="{{ route('ball.index') }}">Balls</a>
               </button>
            </div>

            <div class="pull-right">
               <button class="btn btn-success">
               <a class="btn btn-success" href="{{ route('suggestion.index') }}">Suggestions</a>
               </button>
            </div>
        </div>
  <hr>
    @yield('content')
</div>
</body>
</html>
