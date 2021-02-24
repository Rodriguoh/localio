<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function edit()
    {
    }
    public function create()
    {
        return view('pages/account/comments/addComments');
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

    public function postComment(Request $request)
    {
        $this->validate($request, [
            'codeComment' => 'required|exists:stores,codeComment',
            'note' => 'required',
            'comment' => 'required|max:255',
        ]);
        $comment = new Comment();
        $comment->note = $request->note;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->store_id = Store::where('codeComment', $request->codeComment)->first()->id;
        $comment->save();

        return redirect()->route('myComments')->with('successAdd', 'Votre commentaire à bien été posté.');
    }
}
