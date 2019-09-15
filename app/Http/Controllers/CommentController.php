<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Get approved comments count
     *
     * @return int
     */
    public static function getApprovedCount()
    {
        return Comment::where('status', 'approved')->count();
    }
    /**
     * Get waiting comments count
     *
     * @return int
     */
    public static function getWaitingCount()
    {
        return Comment::where('status', 'waiting')->count();
    }

    /**
     * Stroe a new comment.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validate([
                'post_id' => 'required|exists:posts,id',
                'parent_id' => 'nullable|exists:comments,id',
                'content' => 'required|string|max:65000',
            ]);

            $comment = new Comment();
            $comment->user()->associate($request->user());
        } else {
            $validatedData = $request->validate([
                'post_id' => 'required|exists:posts,id',
                'parent_id' => 'nullable|exists:comments,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'website' => 'nullable|string|url|max:255',
                'content' => 'required|string|max:65000',
            ]);

            $comment = new Comment;
            $comment->author_name = $request->name;
            $comment->author_email = $request->email;
            $comment->author_website = $request->website;
        }

        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->author_ip = request()->ip();
        $comment->author_agent = $request->header('User-Agent');
        $comment->content = $request->content;
        $comment->save();
        
        return back()->with('success', _p('post.comment_sent', 'Your comment was successfully sent.'));
    }
}
