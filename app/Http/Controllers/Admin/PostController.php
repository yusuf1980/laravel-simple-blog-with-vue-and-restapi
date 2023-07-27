<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = 10;
        // if($request->get('page')) {
        //     $show = $request->page;
        // }
        $datas = Post::withCount('comments')->with('user')->orderBy('id', 'desc')->paginate($show);
        return $datas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'type' => 'required',
            'content' => ['required']
        ]);

        $user = auth()->user();

        $item = Post::create([
            'title' => $request->title,
            'user_id' => $user->id,
            'content' => $request->content,
            'status' => $request->type=='publish'?'published':'draft',
        ]);

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'type' => 'required',
            'content' => ['required']
        ]);
        $item = Post::findOrFail($id);
        $item->title = $request->title;
        $item->content = $request->content;
        $item->status = $request->type=='publish'?'published':'draft';
        $item->save();

        return response()->json(['status' => 'success', 'data' => $item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Post::findOrFail($id);
        $post = $item;
        $post->delete();
        return $item;
    }
}
