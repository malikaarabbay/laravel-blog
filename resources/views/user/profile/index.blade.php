@extends('user/app')
@section('bg-img', asset('user/img/contact-bg.jpg'))
@section('title', 'Profile')
@section('subHeading', '')
@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">{{ $user->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4" align="center"> <img height="150" src="{{ Storage::disk('local')->url($user->photo) }}" class="img-circle img-responsive"> </div>
                                <div class=" col-md-8 col-lg-8">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td>Country:</td>
                                            <td>{{ $user->city->region->country->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Region:</td>
                                            <td>{{ $user->city->region->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td>{{ $user->city->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Birthday:</td>
                                            <td>{{ date('d.m.Y', $user->birth ) }}</td>
                                        </tr>

                                        <tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td>{{ ($user->sex == 1) ? 'Male' : 'Female' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="text-right"><a href="{{ route('profile.edit') }}" class="btn btn-default">Edit profile info</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <hr>

@endsection
