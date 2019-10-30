<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\threadcategories;
use App\communityfeed;
use App\user;
use App\replies;
use Alert;
use Carbon;
use DateTime;
use Purifier;
use DB;
use App\Http\Controllers\Controller;

class forumController extends Controller
{
    public function index()
    {
        $thread = communityfeed::all();
        $category = threadcategories::all();
        $all = "2";
        return view('admin.forum.index')->with('thread', $thread)->with('categories', $category)->with('all', $all);
    }

    public function create()
    {
        $category = threadcategories::all();
        return view('admin.forum.create')->with('threadcategories', $category);
    }
    public function bycategory($category)
    {
        $categories = threadcategories::all();
        $cat = threadcategories::where('slug', $category)->first();
        $thread = $cat->thread;
        $all = "1";
        return view('admin.forum.index')->with('thread', $thread)->with('categories', $categories)->with('all', $all);
    }
    public function show($threadID) {

        if (!communityfeed::where('threadID', $threadID)->exists())
        {
            return redirect()->back()->with('error', 'Thread does not exist');
        }
        $currentdate = Carbon\Carbon::now();
        if ($thread->replies()->count() > '0')
        {
            $last = DB::table('replies')->latest('created_at')->first();
            $lastreply = $last->created_at;
            $datetime1 = new DateTime($lastreply);
            $datetime2 = new DateTime($currentdate);
            $reply = $datetime1->diff($datetime2);

            if ($reply->format('%a') > '1')
            {
                $latestreply = $reply->format('%a');
                $format_latest = "d";
            }
            else if ($reply->format('%h') > '0' and $reply->format('%h') < '24')
            {
                $latestreply = $reply->format('%h');
                $format_latest = "h";
            }
            else if ($reply->format('%i') < '60')
            {
                $latestreply = $reply->format('%i');
                $format_latest = "m";
            }
            return view('forums.show')->with('thread', $thread)->with('latestreply', $latestreply)->with('format_latest', $format_latest);
        }
        $thread = communityfeed::find($threadID);

        return view('forums.show')->withthread($thread);
    }

   public function store(Request $request)
   {
       $this->validate ($request, [
           'threadTopic' => 'required|max:255|unique:communityfeed,threadTopic',
           'threadContent' => 'required',
           'category' => 'required',
       ]);
       if (request('status') == "back")
       {
           return redirect()->route('forum.index');
       }
       $userId = Auth::id();
       $thread = new communityfeed();
       $thread->threadTopic = $request->input('threadTopic');
       $thread->threadContent = Purifier::clean($request->input('threadContent'));
       $title = $request->input('threadTopic');
       $slug = str_slug($title);
       $thread->slug = $slug;
       $thread->categoryID = $request->input('category');
       $thread->userID = $userId;
       $thread->save();

       $thread_reply = new replies();
       $thread_reply->reply = Purifier::clean($request->input('threadContent'));
       $thread_reply->thread()->associate($thread);

       $thread_reply->userID = $userId;

       $thread_reply->save();

       return redirect('admin/forum')->with('success', 'Thread Created');
    }

    public function edit($threadID) {

        $thread = communityfeed::find($threadID);
        $categories = threadcategories::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->categoryID] = $category->category;
        }

        return view('admin.forum.edit')->withthread($thread)->withcategories($cats);
    }


    public function update(Request $request, $threadID) {

        $thread = communityfeed::find($threadID);
        if (request('status') == "back")
        {
            return redirect()->route('forums.show', $thread->slug);
        }
        if ($request->input('threadTopic') == $thread->threadTopic) {
            $this->validate ($request, [
                'threadContent' => 'required',
                'categoryID' => 'required',
            ]);
        }
        else
        {
            $this->validate ($request, [
                'threadTopic' => 'required|max:255|unique:communityfeed,threadTopic',
                'threadContent' => 'required',
                'categoryID' => 'required',
            ]);
        }

        $thread = communityfeed::find($threadID);
        $thread->threadTopic = $request->input('threadTopic');
        $thread->threadContent = Purifier::clean($request->input('threadContent'));
        $title = $request->input('threadTopic');
        $slug = str_slug($title);
        $thread->slug = $slug;

        $thread->categoryID = $request->input('categoryID');
        $thread->save();

        $thread_reply = replies::where('threadID', $threadID)->first();
        $thread_reply->reply = Purifier::clean($request->input('threadContent'));

        $thread_reply->save();

        return redirect()->route('forums.show', $thread->slug)->with('success', 'Thread Updated');
     }

     public function destroy($threadID) {

         $thread = communityfeed::find($threadID);
         $thread->delete();
          return redirect('admin/forum')->with('success', 'Thread Deleted');
     }
}
