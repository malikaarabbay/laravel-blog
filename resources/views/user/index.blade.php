@extends('user/app')
@section('bg-img', asset('user/img/home-bg.jpg'))
@section('title', 'Simple title for main')
@section('subHeading', 'Welcome to main page')
@section('main-content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($posts as $post)
                <div class="post-preview">
                    <a href="{{ route('post', $post->slug) }}">
                        <h2 class="post-title">
                            {{ $post->title }}
                        </h2>
                        <h3 class="post-subtitle">
                            {{ $post->sub_title }}
                        </h3>
                    </a>
                    <p class="post-meta">Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y')}}</p>
                </div>
                <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="{{ route('post') }}">Older Posts &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <hr>
@endsection