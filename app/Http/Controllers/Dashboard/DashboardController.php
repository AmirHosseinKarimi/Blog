<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            ],
            'subscribers' => (object)[
                'all' => UserController::getSubscribersCount(),
                'new' => UserController::getNewSubscribersCount(),
            ]
        ];

        return view('dashboard.index', compact('cards'));
    }
}
