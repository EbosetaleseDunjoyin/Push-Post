<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post) : RedirectResponse
    {
        //
        try {
            $validated = $request->validate([
                'body' => 'required|string',
            ]);
            $saveComment = Comment::create([
                'body' => $validated['body'],
                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
            ]);

            if ($saveComment) {
                notify()->success('Comment successfully created');
                return redirect()->route('post.show', $post->id);
            }

            notify()->error('An issue occurred while creating the comment');
            return redirect()->route('post.show', $post->id);

        } catch (Exception $e) {
            
            Log::error($e->getMessage());
            notify()->error("{$e->getMessage()}");
            return redirect()->route('posts.create');
        }

            
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
