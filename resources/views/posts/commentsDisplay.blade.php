@foreach($comments as $comment)
    <div class="comment @if($comment->parent_id === null) p-3 @else mt-3 @endif" id="comment_{{ $comment->id }}" @if($comment->parent_id != null) style="padding-left:20px;border-left: 2px solid #BDBDBD" @endif>
        <div>
            <img class="mr-1 rounded-circle" src="{{ Gravatar::src($comment->author_email, 32) }}">
            @if ($comment->author_website)
                <a href="{{ $comment->author_website }}" class="align-text-top mr-2">
                    <strong>{{ $comment->author_name }}</strong>
                </a>
            @else
                <strong class="align-text-top mr-2">{{ $comment->author_name }}</strong>
            @endif
            <i class="align-text-top" style="color: #9b9b9b">{{ $comment->created_at->format('M d, Y') }}</i>
        </div>
        <div class="mt-2">
            <div class="d-block">{{ $comment->content }}</div>
            <a href="#comment_{{ $comment->id }}" class="d-inline-block mt-2" onclick="comment_reply(event, {{ $comment->id }}, '{{ htmlspecialchars($comment->author_name, ENT_QUOTES) }}')">{{ _p('comment.reply', 'Reply') }}</a>
        </div>

        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
