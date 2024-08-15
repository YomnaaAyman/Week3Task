<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return $post->comments()->with('user:id,name')->get();
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $post->comments()->create($request->validated() + ['user_id'=>Auth::id()]);
        return $comment->load('user:id,name');
    }

    public function show(Post $post, Comment $comment)
    {
        return $comment->load('user:id,name', 'post:id,title,content');
    }

    public function update(UpdateCommentRequest $request, Post $post, Comment $comment)
    {
        if($comment->user_id != Auth::id())
        {
            abort(403, 'you are not authorized to update this comment');
        }
        $comment->update($request->validated());
        return $comment->load('user:idd,name');
    }

    public function destroy(Post $post, Comment $comment)
    {
        if($comment->user_id != Auth::id())
        {
            abort(403, "you are not authorized to delete this post");
        }
        $comment->delete();
        return response()->json('Comment deleted successfully');
    }
}
