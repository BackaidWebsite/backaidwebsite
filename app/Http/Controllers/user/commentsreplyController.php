<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\articlecomment;
use App\comments_replies;
use Alert;
use Purifier;
use App\Http\Controllers\Controller;

class commentsreplyController extends Controller
{
    public function store(Request $request, $commentID)
    {
        $this->validate ($request, [
            'reply' => 'required',
        ]);
        $comment = articlecomment::find($commentID);
        $article = $comment->article;
        $userId = Auth::id();
        $reply = new comments_replies();
        $reply->reply = Purifier::clean($request->input('reply'));
        $reply->articlecomment()->associate($comment);
        $reply->userID = $userId;

        $reply->save();

        return redirect()->route('userarticles.show', $article->slug)->with('success', 'Reply Created');

    }

    public function update(Request $request, $replyID)
    {

         $reply = comments_replies::find($replyID);
         $this->authorize('access', $reply);
         $this->validate($request, array('reply' => 'required'));
         $reply->reply =  Purifier::clean($request->input('reply'));
         $reply->save();

         return redirect()->route('userarticles.show', $reply->articlecomment->article->slug)->with('success', 'Reply Updated');
    }

    public function destroy($replyID)
    {
        $reply = comments_replies::find($replyID);
        $this->authorize('access', $reply);
        $slug = $reply->articlecomment->article->slug;
        $reply->delete();
        return redirect()->route('userarticles.show', $slug)->with('success', 'Reply Deleted');
    }
}
