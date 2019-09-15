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
                'pending' => PostController::getPendingPostsCount()
            ],
            'comments' => (object)[
                'approved' => CommentController::getApprovedCount(),
                'pending' => CommentController::getPendingCount()
            ]
        ];

        return view('dashboard.index', compact('cards'));
    }
}
