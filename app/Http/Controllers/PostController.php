<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\comment;
use App\Models\Like;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        
        $show = 10;
        // if($request->get('page')) {
        //     $show = $request->page;
        // }
        $datas = Post::withCount('comments', 'likes')->orderBy('id', 'desc')->paginate($show);

        return $datas;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return Post::withCount(['comments', 'like_true', 'dislike'])->find($id);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }

    public function comments($id) {
        return Comment::with('user')->where('post_id', $id)->orderBy('id', 'desc')->get();
    }

    public function like(Request $request) {
        $post = Post::findOrFail($request->id);
        $user = auth()->user();
        $exist = $post->like;
        if(!$exist) {
            return $post->like()->create([
                'user_id'=>$user->id,
                'is_like'=>$request->like
            ]);
        }
        else if($exist->is_like !== $request->like) {
            $exist->is_like = $request->like;
            $exist->save();
        }
        return $exist;
    }

    public function unlike(Request $request) {
        return $request->id;
    }

    public function getLIke($id) {
        $post = Post::findOrFail($id);
        $user = auth()->user();
        // $like = Lke::where('user_id', $user->id)->where('post_id');
        $exist = $post->like;
        return $exist;
    }
}
