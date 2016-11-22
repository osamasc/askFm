<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title') | askFm
    </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lobster+Two|Righteous" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">


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