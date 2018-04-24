@extends('admin.layouts.app')
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create new permission</h3>
            </div>
            <!-- form start -->
            <form role="form" action="{{ route('permission.store') }}" method="post">
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
                            <div class="form-group">
                                <label for="for">For</label>
                                <select class="form-control" name="for" id="for">
                                    <option value="post">Post</option>
                                    <option value="user">User</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default" href="{{route('permission.index')}}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"></i> Save</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection