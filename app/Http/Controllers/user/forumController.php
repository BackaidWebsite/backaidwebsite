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
use Carbon;
use DateTime;
use DB;
use Purifier;
use App\Http\Controllers\Controller;

class forumController extends Controller
{
    public function index()
    {
        $thread = communityfeed::all();
        $category = threadcategories::all();
        $all = "2";
        return view('forums.index')->with('thread', $thread)->with('category', $category)->with('all', $all);
    }

    public function create()
    {
        $category = threadcategories::all();
        return view('forums.create')->with('threadcategories', $category);
    }

    public function bycategory($category)
    {
        $categories = threadcategories::all();
        $cat = threadcategories::where('slug', $category)->first();
        $thread = $cat->thread;
        $all = "1";
        return view('forums.index')->with('thread', $thread)->with('category', $categories)->with('all', $all);
    }

    public function show($slug) {

        if (!communityfeed::where('slug', $slug)->exists())
        {
            return redirect()->back()->with('error', 'Thread does not exist');
        }
        $thread = communityfeed::where('slug', '=', $slug)->first();
        $ID = $thread->threadID;
        $first = replies::where('threadID', $ID)->first();
        $thread->increment('view_count');

        $currentdate = Carbon\Carbon::now();
        $created = $thread->created_at;
        $datetime1 = new DateTime($created);
        $datetime2 = new DateTime($currentdate);
        $created = $datetime1->diff($datetime2);

        if ($created->format('%a') > '1')
        {
            $created_date = $created->format('%a');
            $format = "d";
        }
        else if ($created->format('%h') > '0' and $created->format('%h') < '24')
        {
            $created_date = $created->format('%h');
            $format = "h";
        }
        else if ($created->format('%i') < '60')
        {
            $created_date = $created->format('%i');
            $format = "m";
        }

        if ($thread->replies()->count() > '1')
        {
            $last = DB::table('replies')->where('threadID', $ID)->latest('created_at')->first();
            $lastreply = $last->created_at;
            $datetime3 = new DateTime($lastreply);
            $reply = $datetime3->diff($datetime2);

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
            return view('forums.show')->withthread($thread)->with('created_date', $created_date)->with('format', $format)->with('latestreply', $latestreply)->with('format_latest', $format_latest)->with('first', $first);
        }
        else
        {
            return view('forums.show')->withthread($thread)->with('created_date', $created_date)->with('format', $format)->with('first', $first);
        }

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
           return redirect()->route('forums.index');
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
       return redirect()->route('forums.show', $thread->slug)->with('success', 'thread Created');
    }

    public function edit($threadID) {

        $thread = communityfeed::find($threadID);
        $categories = threadcategories::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->categoryID] = $category->category;
        }

        return view('forums.edit')->withthread($thread)->withcategories($cats);
    }


    public function update(Request $request, $threadID) {

        $thread = communityfeed::find($threadID);
        $this->authorize('access', $thread);
        if (request('status') == "back")
        {
            return redirect()->route('forums.show', $thread->slug);
        }

        if ($request->input('threadTopic') == $thread->threadTopic) {
            $this->validate ($request, [
                'threadTopic' => 'required|max:255',
                'threadContent' => 'required',
                'categoryID' => 'required'
            ]);
        }
        else
        {
            $this->validate ($request, [
                'threadTopic' => 'required|max:255',
                'threadContent' => 'required',
                'categoryID' => 'required',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:thread,slug'
            ]);
        }
        $thread = communityfeed::find($threadID);
        $this->authorize('access', $thread);
        $thread->threadTopic= $request->input('threadTopic');
        $thread->threadContent = Purifier::clean($request->input('threadContent'));
        $thread->slug = $request->input('slug');

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
          return redirect('forums')->with('success', 'Thread Deleted');
     }
}
