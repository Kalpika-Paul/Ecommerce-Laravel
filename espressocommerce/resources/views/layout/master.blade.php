<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    @yield('style')
 <title>@yield('title' , 'Ecommerce App')</title>
    @vite('resources/css/app.css')
</head>
<body  style="
background-image: url('{{ asset('assets/img/jjj.jpg') }}'); 
background-size: cover; 
background-position: center; 
background-repeat: no-repeat; 
background-attachment: fixed; 
position: relative; 


"

>



   @yield('content')

    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    @yield('script')
</body>
</html>