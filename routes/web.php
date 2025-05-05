<?php

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Models\Image;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/add', [BlogController::class, 'add']);
Route::post('/blog/create', [BlogController::class, 'create']);
Route::get('/blog/{id}/detail', [BlogController::class, 'show'])->name('blog-detail');
Route::get('/blog/{id}/edit', [BlogController::class, 'edit']);
Route::patch('/blog/{id}/update', [BlogController::class, 'update']);
Route::get('/blog/{id}/delete', [BlogController::class, 'delete']);
Route::get('/blog/{id}/restore', [BlogController::class, 'restore']);

Route::get('/users', [UserController::class, 'index']);

Route::get('/phones', function () {
    $phones = Phone::with('user')->get();
    return $phones;
});

Route::get('/comment', [CommentController::class, 'index']);
Route::post('/comment/{blog_id}', [CommentController::class, 'store']);
Route::get('/images', [ImageController::class, 'index']);
// Route::get('/blog', function () {
//     //ambil dari database
//     $profile = 'aku programmer noob';
//     return view('blog', ['data' =>  $profile]); //cara pertama menampilkan

//     //     // $a = 2;
//     //     // $b = 3;
//     //     // $c = $a + $b;
//     //     // return 'hasil dari variable $c adalah '.$c;

//     //     // return 'Hello World';
// })->name('blog');

//cara kedua
// route::view('/blog', 'blog',['data] => 'Saya Programmer pemula');


// Route::get('/blog/{id}', function (Request $request) {
//     // anggap aja melakukan update data & berhasil
//     return redirect()->route('blog');

//     // return 'ini adalah blog' . $request->id;
// });
