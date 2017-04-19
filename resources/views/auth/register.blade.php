@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تسجيل</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="firstName" type="text" class="form-control" name="firstName"
                                           value="{{ old('firstName') }}" required autofocus>

                                    @if ($errors->has('firstName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="firstName" class="col-md-4 control-label"><span>*&nbsp;</span>الاسم
                                    الاول</label>
                            </div>

                            <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="lastName" type="text" class="form-control" name="lastName"
                                           value="{{ old('lastName') }}" required autofocus>

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="lastName" class="col-md-4 control-label"><span>*&nbsp;</span>اسم
                                    العائلة</label>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="phone" type="number" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="phone" class="col-md-4 control-label"><span>*&nbsp;</span>رقم الجوال</label>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="email" class="col-md-4 control-label"><span>*&nbsp;</span>البريد الالكتروني</label>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="password" class="col-md-4 control-label"><span>*&nbsp;</span>كلمة
                                    المرور</label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                                <label for="password-confirm" class="col-md-4 control-label"><span>*&nbsp;</span>تأكيد كلمة المرور</label>
                            </div>

                            <div class="form-group{{ $errors->has('ssn') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="ssn" type="number" class="form-control" name="ssn"
                                           value="{{ old('ssn') }}" autofocus>

                                    @if ($errors->has('ssn'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ssn') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="ssn" class="col-md-4 control-label">رقم الهوية</label>
                            </div>

                            <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="credit" type="number" class="form-control" name="credit"
                                           value="{{ old('credit') }}" autofocus>

                                    @if ($errors->has('credit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('credit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="credit" class="col-md-4 control-label">credit card</label>
                            </div>

                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="address1" type="text" class="form-control" name="address1"
                                           value="{{ old('address1') }}" autofocus>

                                    @if ($errors->has('address1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="address1" class="col-md-4 control-label">العنوان الاول</label>
                            </div>

                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="address2" type="text" class="form-control" name="address2"
                                           value="{{ old('address2') }}" autofocus>

                                    @if ($errors->has('address2'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="address2" class="col-md-4 control-label">العنوان الثاني</label>
                            </div>

                            <div class="form-group{{ $errors->has('address3') ? ' has-error' : '' }}">

                                <div class="col-md-8">
                                    <input id="address3" type="text" class="form-control" name="address3"
                                           value="{{ old('address3') }}" autofocus>

                                    @if ($errors->has('address3'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address3') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="address3" class="col-md-4 control-label">العنوان الثالث</label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">تسجيل</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
