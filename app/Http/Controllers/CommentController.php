<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        return response()->json([
            'message' => 'Comment successfully created.',
            'data' => new CommentResource($comment->loadMissing(['commentator:id,username']))
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only('comment'));

        return response()->json([
            'message' => 'Comment successfully updated.',
            'data' => new CommentResource($comment->loadMissing(['commentator:id,username']))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'message' => 'Comment successfully soft deleted.',
            'data' => new CommentResource($comment->loadMissing(['commentator:id,username']))
        ]);
    }
}
