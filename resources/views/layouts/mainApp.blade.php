<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>فندق المتحف</title>
    <link href="css1/bootstrap.min.css" rel="stylesheet">
    <link href="css1/animate.min.css" rel="stylesheet">
    <link href="css1/font-awesome.min.css" rel="stylesheet">
    <link href="css1/lightbox.css" rel="stylesheet">
    <link href="css1/main.css" rel="stylesheet">
    <link id="css-preset" href="css1/presets/preset1.css" rel="stylesheet">
    <link href="css1/responsive.css" rel="stylesheet">


    <!--<link href="bootstrap.min.css" rel="stylesheet">-->
    <link id="switcher" href="css1/cyan-theme.css" rel="stylesheet">
    <link href="css1/style.css" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="js1/html5shiv.js"></script>
    <script src="js1/respond.min.js"></script>
    <![endif]-->

    <?php
    if (isset($msg)) {
        echo "<script>"
                . "alert(\"$msg\");"
                . "</script>";
    }
    ?>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <!--<link href='css/css.css' rel='stylesheet' type='text/css'>-->

    <link rel="shortcut icon" href="images/favicon.ico">
    <style>
        /*@import url(http://fonts.googleapis.com/earlyaccess/scheherazade.css);*/
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        * {
            font-family: My-p-Font;
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

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
            </br>
        </div>
    @endif


{{--        {{Session::get('success')}}--}}
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(images/slider/Khaledsafi_biladi00.JPG)">
                <div class="caption">
                    <h1 class="animated fadeInLeftBig">أهــلاً بــكم في <span
                                style="color: #ee5424; font-family: My-label-Font2">المتــــحف</span></h1>
                    <p class="animated fadeInRightBig">فندق - مطعم - قاعة مناسبات - متحف</p>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" href="#services">Start now</a>
                </div>
            </div>
            <div class="item"
                 style="background-image: url(images/slider/11289414_989666651065872_8419490675743974314_o_0.jpg)">
                <div class="caption">
                    <h1 class="animated fadeInLeftBig">أهــلاً بــكم في <span
                                style="color: #ee5424; font-family: My-label-Font2;">المتــــحف</span></h1>
                    <p class="animated fadeInRightBig">فندق - مطعم - قاعة مناسبات - متحف</p>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" href="#services">Start now</a>
                </div>
            </div>
            <div class="item" style="background-image: url(images/slider/Dscf0674.jpg)">
                <div class="caption">
                    <h1 class="animated fadeInLeftBig">أهــلاً بــكم في <span
                                style="color: #ee5424; font-family: My-label-Font2;">المتــــحف</span></h1>
                    <p class="animated fadeInRightBig">فندق - مطعم - قاعة مناسبات - متحف</p>
                    <a data-scroll class="btn btn-start animated fadeInUpBig" href="#services">Start now</a>
                </div>
            </div>
        </div>
        <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

        <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

    </div><!--/#home-slider-->

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
                    <li class="scroll"><a href="#contact">اتصل بنا</a></li>
                    {{--<li class="scroll"><a href="#blog">ألبوم الصور</a></li>--}}
                    {{--<li class="scroll"><a href="#team">فريقنا</a></li>--}}
                    <li class="scroll"><a href="#offers">العروض الجديدة</a></li>
                    <!--<li class="scroll"><a href="#portfolio">الغرف</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">خدماتنا
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="hotel">الفندق</a></li>
                            <li><a href="res">المطعم</a></li>
                            <li><a href="#">قاعة المناسبات</a></li>
                        </ul>
                    </li>
                    <li class="scroll"><a href="#services">نظرة عامة</a></li>
                    <li class="scroll active"><a href="#home">الرئيسية</a></li>
                </ul>

                <!--            --><?//= Menu::display('user', 'bootstrap'); ?>

                <ul class="nav navbar-nav navbar-left">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li class="scroll"><a href="{{ url('/login') }}">دخول</a></li>
                    <li class="scroll"><a href="{{ url('/register') }}">تسجيل</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    خروج
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
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

<script type="text/javascript" src="js1/jquery.js"></script>
<script type="text/javascript" src="js1/bootstrap.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="js1/jquery.inview.min.js"></script>
<script type="text/javascript" src="js1/wow.min.js"></script>
<script type="text/javascript" src="js1/mousescroll.js"></script>
<script type="text/javascript" src="js1/smoothscroll.js"></script>
<script type="text/javascript" src="js1/jquery.countTo.js"></script>
<script type="text/javascript" src="js1/lightbox.min.js"></script>
<script type="text/javascript" src="js1/main.js"></script>

</body>
</html>