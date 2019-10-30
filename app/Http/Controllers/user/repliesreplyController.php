<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\threadcategories;
use App\communityfeed;
use App\User;
use App\replies;
use App\replies_reply;
use Purifier;
use Alert;
use App\Http\Controllers\Controller;

class repliesreplyController extends Controller
{
    public function store(Request $request, $repliesID)
    {
        $this->validate ($request, [
            'reply' => 'required',
        ]);
        $replies = replies::find($repliesID);
        $thread = $replies->thread;
        $userId = Auth::id();
        $reply = new replies_reply();
        $reply->reply = Purifier::clean($request->input('reply'));
        $reply->replies()->associate($replies);
        $reply->userID = $userId;
        $reply->save();
        $parent_reply = new replies();
        $parent_reply->reply = Purifier::clean($request->input('reply'));
        $parent_reply->parentID = $reply->id;
        $parent_reply->thread()->associate($thread);
        $parent_reply->userID = $userId;


        $parent_reply->save();

        return redirect()->route('forums.show', $thread->slug)->with('success', 'Reply Created');

    }

    public function update(Request $request, $replyID)
    {

        $reply = replies_reply::find($replyID);
        $this->authorize('access', $reply);
        $this->validate($request, array('reply' => 'required'));
        $reply->reply = Purifier::clean($request->input('reply'));
        $reply->save();

        return redirect()->route('forums.show', $reply->replies->thread->slug)->with('success', 'Reply Updated');
    }


    public function destroy($repliesID)
    {
        $reply = replies_reply::find($repliesID);
        $this->authorize('access', $reply);
        $slug = $reply->replies->thread->slug;
        $ID = $reply->id;
        $parent_reply = replies::where('parentID', '=', $ID)->first();

        $parent_reply->delete();
        $reply->delete();
        return redirect()->route('forums.show', $slug)->with('success', 'Reply Deleted');
    }
}
