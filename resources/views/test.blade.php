@extends('layouts.resApp')

@section('content')


    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div style="text-align: right" class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp"
                     data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 style="text-align: center">نظـــــــــرة عامــــــــة</h2>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>-->
                    <div style="text-align: center">
                        <p>تمتع بجـــلسة هادئــــة ومريحــــة</p>

                        <p>
                            حـــــيث يطـــــل المطعـــــم علــــى شاطــــئ البحـــــر
                        </p>

                        <h3>
                            يوفرالمطعم خدمة التوصيل السريع ديليفـــــــــري
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{url('/res/check')}}" method="POST">

        @foreach ($foodTypes as $type)

            <section id="{{$type->name}}">
                <div class="bestdisheswrapper">
                    <div id="bestdishes" class="container">

                        <h2 class="wow fadeInUp animated" data-wow-delay="0.3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">{{$type->name}}</h2>
                        <div class="slider">
                            <ul class="slides"
                                style="width: 4400px; transition: -webkit-transform 700ms cubic-bezier(0.165, 0.84, 0.44, 1);">

                                @foreach($type->meals as $meal)
                                    <li class="slide">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="item">
                                            <img src="/images/thumb1.png" width="226" height="225" alt="sliderimg">
                                            <h3><?php echo '$';?>{{$meal->price}}<?php echo '   '; ?>{{$meal->name}}</h3>
                                            @if (Auth::guest())
                                            @else

                                                <INPUT TYPE="NUMBER" MIN="1" MAX="10" STEP="1" VALUE="1"
                                                       SIZE="1" name="amount[{{$meal->id}}]">
                                                <input type="checkbox" name="myCheck[]" value="{{$meal->id}}">

                                            @endif
                                        </div>
                                        {{--</form>--}}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="slider-arrows">
                                <a href="#" class="slider-arrow slider-arrow--right" data-distance="1"></a>
                                <a href="#" class="slider-arrow slider-arrow--left" data-distance="-1"></a>
                            </div>

                        </div> <!-- end of slider-->
                    </div>
                </div>
            </section>

            @endforeach


                    <!--============ BOOK ONLINE ============-->
            <section id="delivery">

                <div class="bookonlinewrapper">
                    <div class="container" id="bookonline">
                        @if (Auth::guest())

                        @else


                            <h3 class="wow fadeInUp animated" data-wow-delay="0.3s"
                                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;"> خدمة
                                التوصيل
                                السريع</h3>

                            <!--  <input type="submit" name="ok" class="btn-success" value="ok">-->

                            <div>
                                <input name="address" type="text" class="name wow zoomIn animated"
                                       placeholder="Your Address"
                                       style="visibility: visible; animation-name: zoomIn;">
                            </div>
                            <div style="padding-left: 55%">
                                <input class="form-control datepicker from wow zoomIn animated" placeholder="date time"
                                       id="date" name="date" placeholder="MM/DD/YYY" required type="datetime"
                                       style="margin-left: 20px"/>
                            </div>
                            {{--<input id="come_date" required type="datetime" class="form-control datepicker"--}}
                            {{--name="come_date"--}}
                            {{--value="{{ old('come_date') }}">--}}

                            {{--<input name="order_date_time" data-format="dd/MM/yyyy hh:mm:ss" type="text"--}}
                            {{--class="datepicker from wow zoomIn animated" placeholder="date time"--}}
                            {{--style="visibility: visible; animation-name: zoomIn;">--}}

                            <button name="ok" class="booknow wow fadeInUp animated"
                                    style="visibility: visible; animation-name: fadeInUp;"> احجز الآن
                            </button>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                    </br>
                                </div>
                            @endif

                        @endif

                    </div>
                </div>
            </section>
    </form>

@endsection