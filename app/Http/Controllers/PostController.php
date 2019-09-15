<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Get published posts list.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getPublishedPosts(int $itemsPerPage = 10)
    {
        return Post::where('status', 'publish')
                   ->whereDate('published_at', '<=', now())
                   ->orderBy('published_at', 'desc')
                   ->paginate($itemsPerPage);
    }

    /**
     * Get published post by slug.
     *
     * @param string $slug
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getPublishedPostBySlug(string $slug)
    {
        return Post::where('slug', $slug)
                   ->whereDate('published_at', '<=', now())
                   ->first();
    }

    /**
     * Get published post by id.
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function getPublishedPostById(int $id)
    {
        return Post::where('id', $id)
                   ->whereDate('published_at', '<=', now())
                   ->first();
    }

    /**
     * Get published posts count.
     *
     * @return int
     */
    public static function getPublishedPostsCount()
    {
        return Post::where('status', 'publish')
                   ->whereDate('published_at', '<=', now())
                   ->count();
    }

    /**
     * Get pending posts count.
     *
     * @return int
     */
    public static function getPendingPostsCount()
    {
        return Post::where('status', 'pending')->count();
    }

    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->getPublishedPosts();
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the post by id.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = $this->getPublishedPostById($id);
        if ($post === null) {
            // 404
        }

        return view('posts.post', compact('post'));
    }

    /**
     * Display the post by slug.
     *
     * @param  string  $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function showBySlug(string $slug)
    {
        $post = $this->getPublishedPostBySlug($slug);

        if ($post === null) {
            // 404
        }

        return view('posts.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
