<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\threadcategories;
use App\communityfeed;
use App\user;
use App\replies;
use App\replies_reply;
use Alert;
use Purifier;
use App\Http\Controllers\Controller;
;

class repliesController extends Controller
{
    public function store(Request $request, $threadID)
    {
        $this->validate ($request, [
            'reply' => 'required',
        ]);
        $thread = communityfeed::find($threadID);
        $userId = Auth::id();
        $reply = new replies();
        $reply->reply = Purifier::clean($request->input('reply'));
        $reply->thread()->associate($thread);
        $reply->userID = $userId;

        $reply->save();

        return redirect()->route('forums.show', $thread->slug)->with('success', 'Reply Created');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $repliesID)
    {
        $reply = replies::find($repliesID);
        $this->authorize('access', $reply);
        $this->validate($request, array('reply' => 'required'));
        $reply->reply = Purifier::clean($request->input('reply'));
        $reply->save();

        return redirect()->route('forums.show', $reply->thread->slug)->with('success', 'Reply Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($repliesID)
    {
        $reply = replies::find($repliesID);
        $this->authorize('access', $reply);
        $slug = $reply->thread->slug;
        if($reply->parentID) {
            $ID = $reply->parentID;
            $parent_reply = replies_reply::where('id', '=', $ID)->first();
            $parent_reply->delete();
        }
        $reply->delete();
        return redirect()->route('forums.show', $slug)->with('success', 'Reply Deleted');
    }
}
