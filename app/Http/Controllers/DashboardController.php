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
            'publishedPostsCount' => PostController::getPublishedPostsCount(),
            'waitingPostsCount' => PostController::getWaitingPostsCount()
        ];

        return view('dashboard.index', compact('cards'));
    }
}
