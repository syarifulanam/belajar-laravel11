<?php

use App\Models\Image;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
// use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
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

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
});

Route::get('upload', function () {
    // Storage::disk('public')->put('example2.txt', 'Contents');
    Storage::put('example2.txt', 'Contents'); // cara pertama
});

Route::get('/thefile', function () {
    // return asset('storage/example2.txt'); //cara pertama
    return Storage::url('example2.txt'); //cara kedua
    // return Storage::get('example2.txt'); // cara ketiga
    // return Storage::size('example2.txt'); // cara keempat
    // return Storage::fileExists('example2.txt'); // cara kelima
});

Route::get('upload-image', function () {
    return view('upload-image');
});

Route::post('/upload-image', function (Request $request) {
    $file = $request->file('image');
    $name = $file->hashName();
    $ext = $file->extension();

    $path = Storage::putFileAs('images', $request->file('image'), 'tesUpload.' . $ext);
    return $path;
});

// $path = $request->file('image')->store('images'); // cara pertama
// $path = $request->file('image')->storeAs('images', 'my-image.jpg'); // cara kedua
// $path = $request->file('image')->storeAs('images', time() . '.' . $request->file('image')->extension()); // cara ketiga

// return $path;

// return Storage::url($path); // cara pertama
// return asset($path); // cara kedua


// Image::create([
//     'name' => $request->file('image')->getClientOriginalName(),
//     'path' => $path,
// ]);

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
