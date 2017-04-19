<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>فندق المتحف</title>
        <link href="/css1/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/css1/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/css1/main.css" rel="stylesheet" type="text/css">
        <link id="css-preset" href="/css1/presets/preset1.css" rel="stylesheet" type="text/css">
        <link href="/css1/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css"
              href="{{ config('voyager.assets_path') }}/js/datetimepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/style.css">

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="/js2/jquery.js"></script>
        <script src="/js2/jquery.glide.js"></script>

        <link rel="stylesheet" href="/css2/style.css">
        <link rel="stylesheet" href="/css2/animate.css">
        <script type="text/javascript" src="/js2/MyJQ.js"></script>
        <script src="/js2/jquery.localScroll.min.js" type="text/javascript"></script>
        <script src="/js2/jquery.scrollTo.min.js" type="text/javascript"></script>
        <script src="/js2/wow.min.js" type="text/javascript"></script>

        <!-- scroll function -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#navigations').localScroll({duration: 800});
            });
        </script>


        <script src="/js2/wow.min.js"></script>
        <script>
            new WOW().init();
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

        <!--  jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    </head><!--/head-->

    <body>

        <!--.preloader-->
        <div class="preloader"><i class="fa fa-circle-o-notch fa-spin"></i></div>
        <!--/.preloader-->

        <header id="home">
            
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{session()->get('message')}}
                <br>
            </div>
            @endif
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
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">

<!--                            <li class="scroll"><a href="#search">بحث</a></li>-->
                            <li class="scroll"><a href="#delivery">حجز</a></li>
                            <li class="dropdown">
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">القائمة
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                     @foreach($foodTypes as $type)
                                     <li><a href="#{{$type->name}}">{{$type->name}}</a></li>
                                     @endforeach
                                </ul>
                            </li>                            
                            <li class="scroll"><a href="#portfolio">نظرة عامة</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">خدماتنا
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="hotel">الفندق</a></li>
                                    <li><a href="res">المطعم</a></li>
                                    <li><a href="#">قاعة المناسبات</a></li>
                                </ul>
                            </li>
                            <li ><a href="{{ url('/') }}">الرئيسية</a></li>
                        </ul>
                        
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

        <script type="text/javascript">
            $('.sliderwrapper .slider').glide({
                autoplay: 7000,
                animationDuration: 3000,
                arrows: true,
            });

        </script>

        <script type="text/javascript">
            $('.bestdisheswrapper .slider').glide({
                autoplay: false,
                animationDuration: 700,
                arrows: true,
                navigation: false,
            });
        </script>


        {{--<script type="text/javascript" src="/js1/jquery.js"></script>--}}
        <script type="text/javascript" src="/js1/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="/js1/jquery.inview.min.js"></script>
        <script type="text/javascript" src="/js1/wow.min.js"></script>
        <script type="text/javascript" src="/js1/mousescroll.js"></script>
        <script type="text/javascript" src="/js1/smoothscroll.js"></script>
        <script type="text/javascript" src="/js1/jquery.countTo.js"></script>
        <script type="text/javascript" src="/js1/lightbox.min.js"></script>
        <script type="text/javascript" src="/js1/main.js"></script>


        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/jquery.matchHeight-min.js"></script>
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/select2/select2.min.js"></script>
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/moment-with-locales.min.js"></script>
        <script type="text/javascript"
                src="{{ config('voyager.assets_path') }}/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <!-- Javascript -->
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/readmore.min.js"></script>
        <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/app.js"></script>

    </body>
</html>
