<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title') | askFm
    </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend.css') }}">

</head>
<body>

    @include('includes.navbar')
   
    <div class="container">
      @yield('content')
    </div>

    <script type="text/javascript">
        @yield('script')    
    </script>
    
    <script src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/backend.js')}}"></script>

</body>
</html>