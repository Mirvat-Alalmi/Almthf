@extends('layouts.hotelApp')

@section('content')
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div style="text-align: right" class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp"
                     data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 style="text-align: center">أكمل تعبئة البيانات للبحث عن غرفة مناسبة </h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <form class="text-center" method="post" action="{{url('/hotel/showroom')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class = "form-group">
                        <input name="come_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="">
                        <lable>تاريخ القدوم</lable>
                    </div>
                    <div class = "form-group">
                        <input name="leave_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="">
                        <lable>تاريخ المغادرة</lable>
                    </div>
                    <div class = "form-group">
                        <input name="adults" type="number" required="">
                        <lable>عدد البالغين</lable>
                    </div>
                    <div class = "form-group">
                        <input name="children" type="number" required="">
                        <lable>عدد الأطفال</lable>
                    </div>
                    <div class = "form-group">
                        <select name="roomtype" width="200%">
                          <option value="1">غرفة فردية</option>
                          <option value="2">غرفة مزدوجة</option>
                          <option value="3">غرفة عائلية</option>
                        </select>
                        <lable>نوع الغرفة</lable>
                    </div>
                    <div class = "form-group">
                        <button type="submit" class="text-center" style="background-color:#ee5424;width:300px;height: 50px;">حجز </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="portfolio-single-wrap">
            <div id="portfolio-single">
            </div>
        </div>
    </section>
@endsection