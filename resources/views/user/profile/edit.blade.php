@extends('user/app')
@section('bg-img', asset('user/img/contact-bg.jpg'))
@section('title', 'Profile edit')
@section('subHeading', '')
@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <p class="text-center">Edit profile</p>
                    <form class="form-horizontal" method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                <select class="form-control" name="country" id="country" required>
                                    {{--<option value="">- Select country -</option>--}}
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}"
                                        @if($country->id == $user->city->region->country->id)
                                            checked
                                        @endif
                                        >{{ $country->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Region</label>
                            <div class="col-md-6">
                                <select name="region" id="region" class="form-control" required>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}"
                                                @if($region->id == $user->city->region->id)
                                                checked
                                                @endif
                                        >{{ $region->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">City</label>
                            <div class="col-md-6">
                                <select name="city_id" id="city" class="form-control" required>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                                @if($city->id == $user->city->id)
                                                checked
                                                @endif
                                        >{{ $city->title }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" required value="{{ old('phone') ? old('phone') : $user->phone }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Photo</label>
                            <div class="col-md-6">
                                <input type="file" id="photo" name="photo">
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                            <label for="birth" class="col-md-4 control-label">Birthday</label>
                            <div class="col-md-6">
                                <input class="birth form-control" name="birth" type="text" value="{{ old('birth') ? old('birth') : date('d.m.Y', $user->birth ) }}">
                                @if ($errors->has('birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <p class="text-center">@lang('messages.change_password')</p>
                    <form class="form-horizontal" method="POST" action="{{ route('profile.change-password', $user) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>
    <hr>

@endsection
@section('footerSection')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script>
        $('.birth').datepicker({
            format: 'dd.mm.yyyy'
        });
        $('#country').change(function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('home/get-region-list')}}?country_id="+countryID,
                    success:function(res){
                        if(res){
                            $("#region").empty();
                            $("#region").append('<option>- Select region -</option>');
                            $.each(res,function(key,value){
                                $("#region").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#region").empty();
                        }
                    }
                });
            }else{
                $("#region").empty();
                $("#city").empty();
            }
        });
        $('#region').on('change',function(){
            var regionID = $(this).val();
            if(regionID){
                $.ajax({
                    type:"GET",
                    url:"{{url('home/get-city-list')}}?region_id="+regionID,
                    success:function(res){
                        if(res){
                            $("#city").empty();
//                            $("#city").append('<option>- Select city -</option>');
                            $.each(res,function(key,value){
                                $("#city").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#city").empty();
                        }
                    }
                });
            }else{
                $("#city").empty();
            }

        });
    </script>
@endsection