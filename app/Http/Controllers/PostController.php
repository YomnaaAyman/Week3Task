<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
      return Auth::user()->posts;
    }

    public function store(StorePostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());
       return $post->load('user:id,name');
    }

    public function show(Post $post)
    {
         return $post->load(['user:id,name', 'comments.user:id,name']);
         //To load the post with associated comments
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            abort(403, 'you are not authorized to update the post');
        }
        return $post->load('user:id,name');
    }

    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            abort(403, 'you are not authorized to delete the post');
        }
        $post->delete('user:id,name');
        return response()->json("post deleted successfully");
    }
}
