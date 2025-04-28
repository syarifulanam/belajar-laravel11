<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    function index()
    {
        $comments = Comment::with('blog')->get();
        return $comments;
    }

    function store(Request $request, $blog_id)
    {
        $request->validate([
            'comment_text' => 'required',
        ]);

        $request['blog_id'] = $blog_id;
        Comment::create($request->all());

        Session::flash('message', 'Comment Successfully Posted!');

        return redirect()->route('blog-detail', $blog_id);
    }
}
