<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController
{
    //
    public function store(Request $request, Post $post): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input['user_id'] = auth()->id();
        $input['post_id'] = $post->id;
        $comment = Comment::create($input);

        return $this->sendResponse($comment->id, 'Comment created successfully.');
    }
}
