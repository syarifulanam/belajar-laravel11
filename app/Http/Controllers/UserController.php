<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $users = User::with('phone', 'image')->get();
        return view('users', ['users' => $users]);
    }
}
