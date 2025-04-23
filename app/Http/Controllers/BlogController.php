<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    function index(Request $request)
    {
        // $title = $request->title;
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->paginate(10);

        // return view('blog', ['blogs' => $blogs, 'title' => $title]); //cara pertama

        $title = $request->title;
        $blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->paginate(10); //cara kedua
        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }

    function add()
    {
        return view('blog-add');
    }

    function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->insert([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]); //cara pertama

        Blog::create($request->all());

        Session::flash('message', 'New Blog Successfully Added!');

        return redirect()->route('blog');
    }

    function show($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first(); // cara pertama
        // $blog = Blog::find($id)->first();  // cara kedua

        $blog = Blog::findOrFail($id); // Cara ke 3
        // if (!$blog) {
        //     abort(404);
        // } //klo sudah pakai findOrFail tidak usah gunakan abort(404) lagi
        return view('blog-detail', ['blog' => $blog]);
    }

    function edit($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first(); //cara pertama
        // if (!$blog) {
        //     abort(404);
        // }
        $blog = Blog::findOrFail($id); //cara kedua
        return view('blog-edit', ['blog' => $blog]);
    }

    function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id . '|max:255',
            'description' => 'required',
        ]);

        // DB::table('blogs')->where('id', $id)->update([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]); //Cara pertama

        $blog = Blog::findOrFail($id);
        $blog->update($request->all()); //Cara kedua

        Session::flash('message', 'Blog Successfully Updated!');
        return redirect()->route('blog');
    }

    function delete($id)
    {  // Penggunaan Hard Delete = menghapus sampai ke database

        // $blog = DB::table('blogs')->where('id', $id)->delete();  //Cara pertama
        Blog::findOrFail($id)->delete(); // Cara ke 

        Session::flash('message', 'Blog Successfully Deleted!');
        return redirect()->route('blog');
    }

    function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id)->restore();
    }
}
