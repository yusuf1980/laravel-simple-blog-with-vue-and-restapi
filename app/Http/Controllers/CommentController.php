<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => ['required', 'string'],
            'post_id' => 'required|exists:posts,id'
        ]);

        $user = auth()->user();

        $item = Comment::create([
            'comment' => $request->comment,
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            ]);

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
