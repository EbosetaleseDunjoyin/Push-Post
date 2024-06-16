<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //
       $posts = Post::where("user_id",auth()->user()->id)->with("comments")->withCount('comments')->get();
        $totalCommentsCount = $posts->sum('comments_count');
        return view('post.index', compact('posts', 'totalCommentsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        //
         try {
            $validated = $request->validate([
                'title' => 'required|string|unique:posts',
                'body' => 'required|string',
            ]);

            $savePost = Post::create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'user_id' => auth()->user()->id,
            ]);

            if ($savePost) {
                notify()->success('Post successfully created');
                return redirect()->route('posts.edit',$savePost->id);
            }

            notify()->error('An issue occurred while creating the post');
            return redirect()->route('posts.create');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            notify()->error("{$e->getMessage()}");
            return redirect()->route('posts.create');
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view("post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return view("post.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'title' => 'required|string|unique:posts,title,' . $post->id . '|max:255',
                'body' => 'required|string',
            ]);

            // Update the post with the validated data
            $post->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
            ]);

            // Notify the user of success
            notify()->success('Post successfully updated');
            return redirect()->route('posts.edit', $post->id);
        } catch (Exception $e) {
            // Log the error and notify the user of the issue
            Log::error($e->getMessage());
            notify()->error("An error occurred: {$e->getMessage()}");
            return redirect()->route('posts.edit', $post->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();

            // Notify the user of success
            notify()->success('Post successfully deleted');
            return redirect()->route('posts.index');
        } catch (Exception $e) {
           
            Log::error($e->getMessage());
            notify()->error("An error occurred: {$e->getMessage()}");
            return redirect()->route('posts.index');
        }

    }
}
