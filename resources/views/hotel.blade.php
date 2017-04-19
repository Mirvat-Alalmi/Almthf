@extends('layouts.hotelApp')

@section('content')
    <section id="portfolio">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    </br>
                </div>
            @endif
            <div class="row">
                <div style="text-align: right" class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp"
                     data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 style="text-align: center">الغــــــرف</h2>
                    <p>يوجد في فندق المتحف 13 غرفة فردية، 6 غرف مزدوجة، 7 أجنحة أعمال، جناح ملكي واحد 5 اجنحة منها 5 غرف
                        وأجنحة بشرف كبيرة و غرفتان بشرفتين صغريتين.

                    </p>
                    <p>
                        مزايا و خصائص:
                    </p>
                    <p>
                        يوجد 32 غرفة وجناح للنزلاء
                        <i style="font-size: 70%; color: #ee5424;" class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </p>
                    <p>
                        انترنت عالي السرعة و مجاني
                        <i style="font-size: 70%; color: #ee5424;" class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </p>
                    <p>
                        فريق عمل يتحدث اللغتين الانجليزية والعربية
                        <i style="font-size: 70%; color: #ee5424;" class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </p>
                    <p>
                        خدمة غسل و كي الملابس
                        <i style="font-size: 70%; color: #ee5424;" class="fa fa-circle-o-notch" aria-hidden="true"></i>
                    </p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            @foreach($roomTypes as $type)
                <div class="col-sm-6 pull-right">
                    <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="folio-image">
                            <img class="img-responsive" src="/images/roomtype/{{$type->image2}}" alt="roomphoto">
                        </div>

                    </div>
                </div>
                <div class="col-sm-1 pull-right"></div>
            @endforeach
        </div>
        <div id="portfolio-single-wrap">
            <div id="portfolio-single">
            </div>
        </div>
    </section>
    <!--/#portfolio-->
    @foreach($roomTypes as $type)
        <section id="details">
            <div class="container">
                <div class="row">
                    <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms"
                         data-wow-delay="300ms">
                        <h2>تفاصيل ال{{$type->name}}</h2>
                    </div>
                </div>
                <div class="team-members">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div class="member-image">
                                    <img class="img-responsive" src="/images/roomtype/{{$type->image1}}" alt="roomphoto">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="member-info" style="text-align: right">
                                <h3>: مزايا و خصائص ال{{$type->name}} </h3>
                                <h4>عدد ال{{$type->name}} {{$type->number_of_rooms}}</h4>
                                {{$type->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <div >
        <form class="text-center"  method="GET" action="{{url('/hotel/bookroom')}}">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group" >
                <button type="submit" class="btn-submit" style="width:300px;display: table;margin: 0 auto;">حجز غرفة</button>
            </div>
        </form>
    </div>
@endsection