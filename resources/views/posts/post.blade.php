@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ config('app.name', 'Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>

                <div class="card my-4">
                    <div class="card-header">
                        <strong>{{ $post->title }}</strong>
                    </div>
                    <div class="card-body">{{ $post->content }}</div>
                    <div class="card-footer d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                {{ _p('main.Date', 'Date') }} : <strong>{{ $post->created_at->format('M d, Y') }}</strong>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('posts.post_short_link', $post->id) }}">{{ _p('post.short_link', 'Short Link') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header">
                        <img class="mr-2" src="{{ Gravatar::src($post->author->email, 24) }}">
                        <strong class="align-text-top">{{ $post->author->name }}</strong>
                    </div>
                    <div class="card-body">{{ $post->author->bio }}</div>
                </div>

                @if( $post->comments )
                    <div class="card my-4">
                        <div class="card-header">
                            {{ _p('post.comments_list_title', 'Comments') }} ({{ $post->comment_count }})
                        </div>
                        <div class="card-body pb-0">
                            @include('posts.commentsDisplay', ['comments' => $post->comments])
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
