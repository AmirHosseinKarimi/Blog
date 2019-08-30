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

            @include('flash-messages')

            <div class="card my-4">
                <div class="card-header">
                    <strong>{{ $post->title }}</strong>
                </div>
                <div class="card-body">{{ $post->content }}</div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            {{ _p('post.Date', 'Date') }} : <strong>{{ $post->created_at->format('M d, Y') }}</strong>
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

            @if ($post->comment_status==='open')
            <div class="card my-4">
                <div class="card-header">{{ _p('post.leave_comment', 'Leave a comment') }}</div>
                <div class="card-body">
                    <form id="post_comment" method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="parent_id" value="">
                        <div class="post-comment-reply mb-3 p-3 d-none" style="background-color:#f2f2f2;">
                            Reply to <strong id="reply_to_name">Amir</strong>
                            (<a href="#" onclick="return comment_reply_cancel(event);">Cancel</a>)
                        </div>
                        @guest
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ _p('comment.fileds.name.label', 'Name')}}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ _p('comment.fileds.name.placeholder', 'John')}}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">{{ _p('comment.fileds.email.label', 'E-mail')}}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ _p('comment.fileds.email.placeholder', 'john@gmail.com')}}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="website">{{ _p('comment.fileds.website.label', 'Website')}}</label>
                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" placeholder="{{ _p('comment.fileds.website.placeholder', 'https://example.com')}}">

                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content">{{ _p('comment.fileds.content.label', 'Comment')}}</label>
                                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}"  placeholder="{{ _p('comment.fileds.content.placeholder', 'Leave you comment')}}" rows="8" maxlength="3000"></textarea>

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="form-group">
                                <label for="content">{{ _p('comment.fileds.content.label', 'Comment')}}</label>
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}"  placeholder="{{ _p('comment.fileds.content.placeholder', 'Leave you comment')}}" rows="8" maxlength="3000"></textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endguest
                        <button type="submit" class="btn btn-block btn-primary">{{ _p('comment.fileds.submit.text', 'Post comment')}}</button>
                    </form>
                </div>
            </div>
            @endif

            @if( count($post->comments) )
            <div class="card my-4">
                <div class="card-header">
                    {{ _p('comment.list_title', 'Comments') }} ({{ $post->comment_count }})
                </div>
                <div class="card-body post-comments p-0">
                    @include('posts.commentsDisplay', ['comments' => $post->comments])
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
