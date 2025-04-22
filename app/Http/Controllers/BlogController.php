<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    function index(Request $request)
    {
        $title = $request->title;
        $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->paginate(10);

        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }
}
