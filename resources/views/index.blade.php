@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
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
                                    {{ _p('post.date', 'Date') }} : <span>{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="mr-3">
                                    {{ _p('post.author', 'Author') }} : <span>{{$post->author->name}}</span>
                                </div>
                              @if ($post->comment_status==='open')
                                <div class="mr-3">
                                    {{ _p('post.comments', 'Comments') }} : <span>{{$post->comment_count}}</span>
                                </div>
                              @endif
                            </div>
                            <div>
                                <a href="{{ route('posts.post_link', $post->slug) }}" class="btn btn-sm btn-primary">{{ _p('post.read_more', 'Read More') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-center mt-4">
                    <div class="d-inline-block">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
