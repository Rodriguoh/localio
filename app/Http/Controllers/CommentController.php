<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:comments,id',
            'note' => 'required',
            'comment' => 'required|max:255',
        ]);
        $comment = Comment::findOrFail($request->id);
        $comment->note = $request->note;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with($comment->wasChanged() ? 'successEdit' : '', 'Le commentaire a bien été modifié.');
    }


    public function create()
    {
        return view('pages/account/comments/addComments');
    }
    public function delete(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if ($comment->user_id != Auth::id()) abort(403);
        $comment->delete();

        return redirect()->back()->with('successDelete', 'Votre commentaire a été supprimé avec succés.');
    }

    public function comments()
    {
        $comments = Auth::user()->comments()->with('store')->paginate(8);
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
