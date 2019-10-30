<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\article;
use App\User;
use App\articlecomment;
use App\comments_replies;
use Alert;
use Purifier;
use App\Http\Controllers\Controller;

class commentsController extends Controller
{
    public function store(Request $request, $articleID)
    {
        $this->validate ($request, [
            'comment' => 'required',
        ]);
        $article = article::find($articleID);
        $userId = Auth::id();
        $comment = new articlecomment();
        $comment->comment = Purifier::clean($request->input('comment'));
        $comment->article()->associate($article);
        $comment->userID = $userId;

        $comment->save();

        return redirect()->route('userarticles.show', $article->slug)->with('success', 'Comment Created');
    }


    public function update(Request $request, $commentID)
    {
        $comment = articlecomment::find($commentID);
         $this->authorize('access', $comment);

        if (request('cancel') == "back")
        {
            return redirect()->route('userarticles.show', $comment->article->slug);
        }
        $this->validate($request, array('comment' => 'required'));

        $comment->comment = Purifier::clean($request->input('comment'));
        $comment->save();

        return redirect()->route('userarticles.show', $comment->article->slug)->with('success', 'Comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($commentID)
    {
        $comment = articlecomment::find($commentID);
        $this->authorize('access', $comment);
        $slug = $comment->article->slug;
        $comment->delete();
        return redirect()->route('userarticles.show', $slug)->with('success', 'Comment Deleted');
    }
}
