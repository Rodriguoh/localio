<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function edit()
    {
    }
    public function create()
    {
    }
    public function delete()
    {
    }
    public function comments()
    {
        $comments = Auth::user()->comments()->paginate(8);
        return view('pages/account/comments/myComments', [
            'comments' => $comments
        ]);
    }
}
