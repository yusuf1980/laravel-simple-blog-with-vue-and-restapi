<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class AdminController extends Controller
{
    public function dashboard()
    {        
        $datas = Post::withCount('comments')->with('user')->orderBy('id', 'desc')->limit(5)->get();
        $posts_count = Post::get()->count();
        $userCount = User::get()->count();
        $commentCount = Comment::get()->count();

        return ['posts'=>$datas, 'posts_count'=>$posts_count, 'user_count'=>$userCount, 'comment_count'=>$commentCount];
    }
}
