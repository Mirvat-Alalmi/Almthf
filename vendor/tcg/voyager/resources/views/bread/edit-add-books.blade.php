@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@if(isset($dataTypeContent->id))
    @section('page_title','Edit '.$dataType->display_name_singular)
@else
    @section('page_title','Add '.$dataType->display_name_singular)
@endif

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Add New' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                        {{ method_field("PUT") }}
                        @endif

                                <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                        <!-- If we are editing -->
                                @if(isset($dataTypeContent->id))
                                    <?php $dataTypeRows = $dataType->editRows; ?>
                                @else
                                    <?php $dataTypeRows = $dataType->addRows; ?>
                                @endif

                                <div class="form-group">
                                    <label>اسم المستخدم</label>
                                    <select id="user_id" name="user_id" class="form-control">
                                        @foreach(\App\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>عدد البالغين</label>
                                    <input id="number_of_adults" type="number" name="number_of_adults"
                                           class="form-control" placeholder="1"
                                           value="{{ old('number_of_adults') }}">
                                </div>
                                <div class="form-group">
                                    <label>عدد الأطفال</label>
                                    <input id="number_of_children" type="number" name="number_of_children"
                                           class="form-control" placeholder="1"
                                           value="{{ old('number_of_children') }}">
                                </div>
                                <div class="form-group ">
                                    <label for="name">Come Date</label>
                                    <input id="come_date" required type="datetime" class="form-control datepicker"
                                           name="come_date"
                                           value="{{ old('come_date') }}">
                                </div>
                                <div class="form-group ">
                                    <label for="name">Leave Date</label>
                                    <input id="leave_date" required type="datetime" class="form-control datepicker"
                                           name="leave_date"
                                           value="{{ old('leave_date') }}">
                                </div>

                                {{--@foreach($dataTypeRows as $row)--}}
                                {{--<div class="form-group @if($row->type == 'hidden') hidden @endif">--}}
                                {{--<label for="name">{{ $row->display_name }}</label>--}}
                                {{--@include('voyager::multilingual.input-hidden-bread')--}}
                                {{--{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}--}}

                                {{--@foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)--}}
                                {{--{!! $after->handle($row, $dataType, $dataTypeContent) !!}--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--@endforeach--}}

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="button" id="button"
                                    onclick="showUser(document.getElementById('user_id').value,document.getElementById('number_of_adults').value,document.getElementById('number_of_children').value,(new Date(document.getElementById('come_date').value)),(new Date(document.getElementById('leave_date').value)))"
                                    class="btn btn-default save">بحث عن غرفة
                            </button>
                        </div>
                    </form>
                    <br>
                    <div id="txtHint"><b></b></div>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });
        });
    </script>
    @if($isModelTranslatable)
        <script src="{{ config('voyager.assets_path') }}/js/multilingual.js"></script>
    @endif
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/slugify.js"></script>
@stop
