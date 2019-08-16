@foreach($comments as $comment)
    <div class="display-comment mb-4" id="comment_{{ $comment->id }}" @if($comment->parent_id != null) style="padding-left:20px;border-left: 2px solid #BDBDBD" @endif>
        <div>
            <img class="mr-2" src="{{ Gravatar::src($comment->author_email, 24) }}">
            @if ($comment->author_website)
                <a href="{{ $comment->author_website }}" class="align-text-top mr-2">
                    <strong>{{ $comment->author_name }}</strong>
                </a>
            @else
                <strong class="align-text-top mr-2">{{ $comment->author_name }}</strong>
            @endif
            <i class="align-text-top" style="color: #455A64">{{ $comment->created_at->format('M d, Y') }}</i>
        </div>
        <p class="mt-2">
            {{ $comment->content }}
            <br>
            <a href="#comment_{{ $comment->id }}">{{ _p('post.commend_reply', 'Reply') }}</a>
        </p>

        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach