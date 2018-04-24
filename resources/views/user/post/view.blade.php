@extends('user/app')
@section('bg-img', Storage::disk('local')->url($model->photo))
@section('title', $model->title)
@section('subHeading', $model->sub_title)
@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9 col-lg-9">
                    <p>Created: {{ \Carbon\Carbon::parse($model->created_at)->format('d.m.Y')}}</p>
                   {!! htmlspecialchars_decode($model->description) !!}
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    @if($model->categories)
                        <p>Categories</p>
                        <ul class="list-unstyled">
                            @foreach($model->categories as $category)
                                <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    @if($model->tags)
                        <p>Tags</p>
                        <ul class="list-unstyled">
                            @foreach($model->tags as $tag)
                                <li><a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </article>

    <hr>

@endsection