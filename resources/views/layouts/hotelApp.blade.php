<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>فندق المتحف</title>
    <link href="/css1/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css1/animate.min.css" rel="stylesheet" type="text/css">
    <link href="/css1/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css1/lightbox.css" rel="stylesheet" type="text/css">
    <link href="/css1/main.css" rel="stylesheet" type="text/css">
    <link id="css-preset" href="/css1/presets/preset1.css" rel="stylesheet" type="text/css">
    <link href="/css1/responsive.css" rel="stylesheet" type="text/css">
    <link href="/css1/datepicker3.css" rel="stylesheet" type="text/css">


    <!--<link href="bootstrap.min.css" rel="stylesheet">-->
    <link id="switcher" href="/css1/cyan-theme.css" rel="stylesheet" type="text/css">
    <link href="/css1/style.css" rel="stylesheet" type="text/css">


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <!--<link href='css/css.css' rel='stylesheet' type='text/css'>-->

    <link rel="shortcut icon" href="/images/favicon.ico">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="/css1/jquery.dataTables.min.css" type="text/css">
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>


    <style>
        /*@import url(http://fonts.googleapis.com/earlyaccess/scheherazade.css);*/
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        * {
            font-family: 'Droid Arabic Kufi', serif;
        }

        p {
            font-size: 14px;
        }
    </style>
</head><!--/head-->

<body>

<!--.preloader-->
<div class="preloader"><i class="fa fa-circle-o-notch fa-spin"></i></div>
<!--/.preloader-->

<header id="home">
    <div class="main-nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <!--<h1><img class="img-responsive" src="images/logo.png" alt="logo"></h1>-->
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                    <li class="scroll"><a href="{{url('hotel/search')}}">بحث</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">حجز
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            {{--@foreach($roomTypes as $type)--}}
                            {{--<li><a href="{{url('/hotel/rooms/'.$type->id)}}">{{$type->name}}</a></li>--}}
                            {{--@endforeach--}}

                        </ul>
                    </li>
                    <li class="scroll"><a href="#details">تفاصيل</a></li>
                    <li class="scroll"><a href="#portfolio">نظرة عامة</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">خدماتنا
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="hotel">الفندق</a></li>
                            <li><a href="#">المطعم</a></li>
                            <li><a href="#">قاعة المناسبات</a></li>
                        </ul>
                    </li>
                    <li class="scroll active"><a href="{{ url('/') }}">الرئيسية</a></li>
                </ul>
            </div>

            <!--            --><?//= Menu::display('user', 'bootstrap'); ?>
        </div>
    </div><!--/#main-nav-->
</header><!--/#home-->

@yield('content')

<footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container text-center">
            <div class="footer-logo">
                <a href="index.html">
                    <h2 style="color: white">
                        المتــــحف 2016
                    </h2>
                    <!--<img class="img-responsive" src="images/logo.png" alt="">-->
                </a>
            </div>
            <div class="social-icons">
                <ul>
                    <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>&copy; المتــــحف 2016</p>
                </div>
                <div class="col-sm-6">
                    <!--<p class="pull-right">Designed by <a href="http://www.themeum.com/">Themeum</a></p>-->
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="/js1/jquery.js"></script>
<script type="text/javascript" src="/js1/bootstrap.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/js1/jquery.inview.min.js"></script>
<script type="text/javascript" src="/js1/wow.min.js"></script>
<script type="text/javascript" src="/js1/mousescroll.js"></script>
<script type="text/javascript" src="/js1/smoothscroll.js"></script>
<script type="text/javascript" src="/js1/jquery.countTo.js"></script>
<script type="text/javascript" src="/js1/lightbox.min.js"></script>
<script type="text/javascript" src="/js1/main.js"></script>


<script type="text/javascript" charset="utf8" src="/js1/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="/js1/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="/js1/bootstrap-datepicker.js"></script>

<script>
    $('.datepicker').datepicker({
        format: 'yyy-mm-dd'
    });
</script>
</body>
</html>
