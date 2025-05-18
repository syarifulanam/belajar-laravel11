<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    function index(Request $request)
    {
        // $title = $request->title;
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->paginate(10);

        // return view('blog', ['blogs' => $blogs, 'title' => $title]); //cara pertama
        
        // ini cara 1 gate policy
        Gate::authorize('viewAny', Blog::class); // menggunakan Gate

        // ini cara 2 mirip gate policy
        // if (Auth::user()->active == 0) {
        //     abort(403, 'Akun login Anda tidak aktif. Hubungi admin untuk mengaktifkan akun Anda.');
        // }

        // if ($request->user()->cannot('viewAny', Blog::class)) {
        //     abort(403);
        // }

        $title = $request->title;
        $blogs = Blog::with(['tags', 'comments', 'image', 'ratings', 'categories'])->where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'asc')->paginate(); //cara kedua
        return view('blog', ['blogs' => $blogs, 'title' => $title]);
    }

    function add()
    {
        $tags = Tag::all();
        return view('blog-add', ['tags' => $tags]);
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
        // $blog = Blog::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ]);

        // if ($request->has('tags')) {
        //     $blog->tags()->attach($request->tags);
        // }

        $blog = Blog::create($request->all()); // simpan data blog
        $blog->tags()->attach($request->tags); // update untuk simpan data TAGS pada blog tersebut

        Session::flash('message', 'New Blog Successfully Added!');

        return redirect()->route('blog');
    }

    function show($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first(); // cara pertama
        // $blog = Blog::find($id)->first();  // cara kedua

        $blog = Blog::with(['comments', 'tags'])->findOrFail($id); // Cara ke 3
        // if (!$blog) {
        //     abort(404);
        // } //klo sudah pakai findOrFail tidak usah gunakan abort(404) lagi
        return view('blog-detail', ['blog' => $blog]);
    }

    function edit(Request $request, $id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->first(); //cara pertama
        // if (!$blog) {
        //     abort(404);
        // }
        $tags = Tag::all();
        $blog = Blog::with(['comments'])->findOrFail($id); //cara kedua

        Gate::authorize('update', $blog);

        return view('blog-edit', ['blog' => $blog, 'tags' => $tags]);
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

        if ($request->user()->cannot('update', $blog)) {
            abort(403);
        }

        $blog->tags()->sync($request->tags);
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
