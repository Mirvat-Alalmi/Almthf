@extends('layouts.hotelApp')

@section('content')
    <section id="portfolio">

        <div class="container-fluid">
            <div class="row">

                {{-- <table id="example" class="display" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الوصف</th>
                        <th>السعر في الليلة</th>
                        <th>نوع الغرفة </th>
                        <th>رقم الغرفة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{$room->description}}</td>
                            <td>{{$room->price}}</td>
                            @if($room->room_type_id == 1)
                            <td>غرفة فردية</td>
                            @elseif ($room->room_type_id == 2)
                            <td>غرفة مزدوجة</td>
                            @endif
                            <td>{{$room->id}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}

                <form  style="text-align:right;" method="post" action="{{url('/hotel/bookroom')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{-- <div class = "form-group">
                        <select name="room_id" style="width:150px;">
                            @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->id}}</option>
                            @endforeach
                        </select>
                        <lable>قم باختيار رقم الغرفة</lable>
                    </div> --}}
                    <div class = "row">
                        <div class="col-sm-1 pull-right"></div>
                        <lable class = "col-sm-1  pull-right">تاريخ القدوم</lable>
                        <input class = "col-sm-1 pull-right" name="come_date" value="{{$come_date}}" readonly>
                        <lable class = "col-sm-1 pull-right" >تاريخ المغادرة</lable>
                        <input class = "col-sm-1 pull-right" name="leave_date" value="{{$leave_date}}" readonly>
                        <lable class = "col-sm-1 pull-right" >نوع الغرفة</lable>
                        <input class = "col-sm-1 pull-right" name="roomtype" value="{{$type}}" readonly>
                        <lable class = "col-sm-1 pull-right" >عدد البالغين</lable>
                        <input class = "col-sm-1 pull-right" name="adults"  value="{{$adults}}" readonly>
                        <lable class = "col-sm-1 pull-right" >عدد الأطفال</lable>
                        <input class = "col-sm-1 pull-right" name="children" value="{{$children}}" readonly>
                    </div>
                    <br><br>
                    <div class = "row">
                        <div class="col-sm-1 pull-right"></div>
                        <lable style="font-size:170%;color:orange;" class = "col-sm-5 pull-right" >الغرف المتاحة</lable>
                    </div>
                    <br><br>
                    @foreach($rooms as $room)
                        <div class = "row">
                            <div class="col-sm-1 pull-right"></div>
                            <div class="col-sm-5 pull-right">
                                <img src="/images/rooms/{{$room->image}}" alt="room_photo" width="500" height="300">
                            </div>
                            <div class="col-sm-3 pull-right">
                                <div class="row">
                                    <div class="col-sm-1 pull-right"></div>
                                    <div class="col-sm-3 pull-right">
                                        <lable style="font-size:100%;"> رقم الغرفة </lable>
                                    </div>
                                    <div class="col-sm-6 pull-right">
                                        <lable style="font-size:170%;color:orange;">{{$room->id}}</lable>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-1 pull-right"></div>
                                    <div class="col-sm-3 pull-right">
                                        <lable style="font-size:100%;"> مواصفات</lable>
                                    </div>
                                    <div class="col-sm-6 pull-right">
                                        <lable style="font-size:100%;">{{$room->description}}</lable>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-1 pull-right"></div>
                                    <div class="col-sm-3 pull-right">
                                        <lable style="font-size:100%;"> سعر الليلة </lable>
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <lable style="font-size:170%;color:orange;">{{$room->price}}&emsp;</lable>
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <lable style="font-size:100%;"> دولار </lable>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group" >
                                    <button type="submit" class="btn-submit" name="booked" value="{{$room->id}}" style="width:300px;height: 50px;">حجز الغرفة</button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr width="50%" style="border-top: 3px solid #ccc;">
                    @endforeach
                </form>
            </div>
        </div>
        <div id="portfolio-single-wrap">
            <div id="portfolio-single">
            </div>
        </div>
    </section>
@endsection