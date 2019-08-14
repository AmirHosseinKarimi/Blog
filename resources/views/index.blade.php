@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('status'))
                    <div class="card">
                        <div class="card-header">Dashboard</div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

                @foreach($posts as $post)
                    <div class="card mt-4">
                        <div class="card-header">
                            <a href="{{ route('posts.post_link', $post->slug) }}">
                                <strong>{{$post->title}}</strong>
                            </a>
                        </div>
                        <div class="card-body">{{$post->excerpt}}</div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    Date : <strong>{{ $post->created_at->format('M d, Y') }}</strong>
                                </div>
                                <div class="mr-3">
                                    Author : <strong>{{$post->author->name}}</strong>
                                </div>
                                <div class="mr-3">
                                    Comments : <strong>{{$post->comment_count}}</strong>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('posts.post_link', $post->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
