@extends('admin.layouts.app')
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create new user</h3>
            </div>
            <!-- form start -->
            <form role="form" action="{{ route('user.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Repeate Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="status" value="1"
                                        @if(old('status') == 1)
                                            checked
                                        @endif
                                        > Status
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-lg-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="role[]" value="{{ $role->id }}"> {{ $role->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default" href="{{route('user.index')}}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection