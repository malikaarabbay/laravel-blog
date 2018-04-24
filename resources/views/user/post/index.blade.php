@extends('user/app')
@section('bg-img', asset('user/img/post-bg.jpg'))
@section('title', 'All posts')
@section('subHeading', '')
@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                @foreach($models as $model)
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="thumbnail">
                        <img src="{{ Storage::disk('local')->url($model->photo)}}" alt="{{ $model->title }}">
                        <div class="caption">
                            <h3>{{ $model->title }}</h3>
                            <p>{{ \Carbon\Carbon::parse($model->created_at)->format('d.m.Y')}}</p>
                            <p>{{ $model->sub_title }}</p>
                            <p><a href="{{ route('post', $model->slug) }}" class="btn btn-default" role="button">Read more</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {{ $models->links() }}
                </div>
            </div>
        </div>
    </article>

    <hr>

@endsection