<!DOCTYPE html>
<html>
<head>
    <title>Blog App</title>
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>



  </head>
<body>
  <br />h

<div class="container">
@if(Auth::user() != null)
  <p class="text-right p-10">
  <span class="pr-5">Hello  {{ Auth::user()->name }}</span> <span class="pr-5"><a href="{{ route('logout') }}">Sign Out</a></span>
</p>
  @endif
  
    @yield('content')
</div>
   
</body>
</html>