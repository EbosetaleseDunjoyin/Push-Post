<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    //    
    /**
     * listPosts
     *
     * @return JsonResponse
     */
    public function listPosts(): JsonResponse
    {
        $posts = Post::all();

        return $this->sendResponse(PostResource::collection($posts), 'Posts retrieved successfully.');
    }
    
    /**
     * usersPost
     *
     * @param  mixed $user
     * @return JsonResponse
     */
    public function usersPost(User $user): JsonResponse
    {
        $posts = Post::where("user_id",$user->id)->get();

        return $this->sendResponse(PostResource::collection($posts), "User's Posts retrieved successfully.");
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|unique:posts',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input['user_id'] = auth()->id();
        $post = Post::create($input);

        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    }

        
    /**
     * getPost
     *
     * @param  mixed $post
     * @return JsonResponse
     */
    public function getPost(Post $post): JsonResponse
    {
        try{
            $post = $post->load("comments");
            if (is_null($post)) {
                return $this->sendError('Post not found.');
            }
            return $this->sendResponse($post, 'Post retrieved successfully.');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return $this->sendError('Issue Occured', $e->getMessage());
        }

    }







}
