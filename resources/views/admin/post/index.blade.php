@extends('admin.layouts.app')
@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('main-content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Posts</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div> <!-- end .flash-message -->
                    </div>
                </div>
                @can('posts.create', Auth::user())
                <div class="row">
                    <div class="col-xs-12">
                        <a class="btn btn-success" href="{{ route('post.create') }}"><i class="glyphicon glyphicon-plus"></i> Add post</a>
                    </div>
                </div>
                @endcan
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <form role="form" action="{{ route('post.search') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="query" name="query" placeholder="enter query ...">
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th># id</th>
                                <th>Title</th>
                                <th>Created</th>
                                <th>Publish</th>
                                @can('posts.update', Auth::user())<th>Edit</th>@endcan
                                @can('posts.delete', Auth::user())<th>Delete</th>@endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->title }}</td>
                                    <td>{{ $model->created_at }}</td>
                                    <td>{{ $model->is_published? 'Published' : 'Not published' }}</td>
                                    @can('posts.update', Auth::user())
                                    <td><a class="btn btn-warning" href="{{ route('post.edit', $model->id) }}"><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>
                                    @endcan
                                    @can('posts.delete', Auth::user())
                                    <form style="display: none" id="delete-form-{{ $model->id }}" method="post" action="{{ route('post.destroy', $model->id) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <td><a class="btn btn-danger" href="" onclick="
                                    if(confirm('Are you sure, Want to delete this?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $model->id }}').submit();
                                    } else {
                                        event.preventDefault();
                                    }
                                    "><i class="glyphicon glyphicon-remove"></i> Delete</a></td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th># id</th>
                                <th>Title</th>
                                <th>Created</th>
                                <th>Publish</th>
                                @can('posts.update', Auth::user())<th>Edit</th>@endcan
                                @can('posts.delete', Auth::user())<th>Delete</th>@endcan
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@section('footerSection')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection