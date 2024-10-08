<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);
        return PostDetailResource::collection($posts->loadMissing(['writer:id,username,email', 'comments:id,post_id,user_id,comment']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());

        return response()->json([
            'message' => 'Post successfully created.',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username,email'))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('writer:id,username,email')->findOrFail($id);
        // return response()->json(['data' => $post]);
        return new PostDetailResource($post->loadMissing(['writer:id,username,email', 'comments:id,post_id,user_id,comment']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json([
            'message' => 'Post successfully update.',
            'data' => new PostDetailResource($post->loadMissing(['writer:id,username,email', 'comment']))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Post successfully soft deleted.',
            'data' => new PostDetailResource($post->loadMissing('writer:id,username,email'))
        ]);
    }
}
