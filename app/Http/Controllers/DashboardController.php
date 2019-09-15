<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cards = (object) [
            'posts' => (object)[
                'published' => PostController::getPublishedPostsCount(),
                'waiting' => PostController::getWaitingPostsCount()
            ],
            'comments' => (object)[
                'approved' => CommentController::getApprovedCount(),
                'waiting' => CommentController::getWaitingCount()
            ]
        ];

        return view('dashboard.index', compact('cards'));
    }
}
