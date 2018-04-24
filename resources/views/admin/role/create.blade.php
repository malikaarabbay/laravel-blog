@extends('admin.layouts.app')
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create new role</h3>
            </div>
            <!-- form start -->
            <form role="form" action="{{ route('role.store') }}" method="post">
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
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Post permissions</label>
                            @foreach($models as $model)
                                @if($model->for == 'post')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{ $model->id }}" name="permission[]"> {{ $model->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <label>Post permissions</label>
                            @foreach($models as $model)
                                @if($model->for == 'user')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{ $model->id }}" name="permission[]"> {{ $model->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-3">
                            <label>Post permissions</label>
                            @foreach($models as $model)
                                @if($model->for == 'other')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="{{ $model->id }}" name="permission[]"> {{ $model->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default" href="{{route('role.index')}}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection