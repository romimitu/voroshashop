<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="frontend/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="frontend/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="frontend/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="frontend/ico/favicon.png">
    <link rel="shortcut icon" href="frontend/ico/favicon.png">
    <title>VOROSA SHOP - Buy online in Dhaka, Buy Medicines Online | Home Delivery of Medicine and Healthcare Products in Dhaka.</title>
    <meta name="keywords" content="Buy  online in Dhaka, Buy Medicines Online, Home Delivery of Medicine and Healthcare Products in Dhaka.">
    <meta name="description" content="  Buy  online in Dhaka, Buy Medicines Online | Home Delivery of Medicine and Healthcare Products in Dhaka.">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{!!asset('css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
</head>

<body>
  	@include('frontend.layouts.header')

    @yield('content')

  	@include('frontend.layouts.footer')
</body>

</html>