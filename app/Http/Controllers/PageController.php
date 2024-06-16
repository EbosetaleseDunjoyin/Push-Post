<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $search = $request->query('search');

        $posts = Post::with('comments', 'user')
                     ->latest()
                    ->when($search, function ($query, $search) {
                        $query->where('title', 'like', '%' . $search . '%')
                              ->orWhere('body', 'like', '%' . $search . '%');
                    })
                    ->paginate(30);

        return view('home', compact('posts', 'search'));
    }
}
