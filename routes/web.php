<?php

use App\Models\User;
use App\Models\Image;
use App\Models\Phone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ProcessWelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Email;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ImageController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;


// use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    // return auth()->user()->name;
    // return auth()->user();
    return Auth::user()->name;
})->middleware('verified');

Route::middleware(['auth', 'verified'])->group(function () {
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
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'createuser']);

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();


        return redirect('/profile');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
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

Route::get('/send-welcome-mail', function () {
    $users = [
        ['email' => 'john@email.com', 'password' => '123'],
        ['email' => 'johe@email.com', 'password' => '123'],
        ['email' => 'johdor@email.com', 'password' => '123'],
        ['email' => 'johs@email.com', 'password' => '123'],
        ['email' => 'johb@email.com', 'password' => '123'],
        ['email' => 'johm@email.com', 'password' => '123'],
        ['email' => 'johi@email.com', 'password' => '123'],
        ['email' => 'joho@email.com', 'password' => '123'],
        ['email' => 'johe@email.com', 'password' => '123'],
        ['email' => 'jo@email.com', 'password' => '123'],
    ];

    foreach ($users as $user) {
        ProcessWelcomeMail::dispatch($user)->onQueue('kirim-email');
    }
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
