<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(Request $request, $id)
    {
        $comment = new Comment();
        $comment->comm_user_id = \Auth::user()->id;
        $comment->comm_post_id = $id;
        $comment->comm_text = $request->commentText;
        $comment->save();
        return redirect()->route('view', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment)
        {
            return view('posts.e404');
        }
        if(\Auth::user()->id != $comment->comm_user_id)
        {
            return redirect()->route('index')->withErrors('Вы не можете удалить этот комментарий');
        }
        $comment->delete();
        return redirect()->route('view', $id);
    }
}
