<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function report($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->flagged = true;
        $comment->save();

        return true;
    //  return redirect()->back()->with($comment->wasChanged() ? 'successEdit' : '', 'Le commentaire a bien été signalé.');
    }
}
