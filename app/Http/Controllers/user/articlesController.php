<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\articlecategories;
use App\article;
use App\User;
use App\roles;
use App\articlecomment;
use Alert;
use Purifier;
use Image;
use DB;
use App\Http\Controllers\Controller;

class articlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $articles = article::all();
        $first = DB::table('article')->latest('created_at')->first();
        $category = articlecategories::all();
        $all = "1";

        return view('articles.index')->with('article', $articles)->with('category', $category)->with('first', $first)->with('all', $all);

    }
    public function bycategory($category)
    {
            $categories = articlecategories::all();
            $cat = articlecategories::where('slug', $category)->first();
            $articles = $cat->articles;
            $all = "2";
            return view('articles.index')->with('article', $articles)->with('category', $categories)->with('all', $all);
    }
    public function show($slug) {

        if (!article::where('slug', $slug)->exists())
        {
            return redirect()->back()->with('error', 'Article does not exist');
        }
        $article = article::where('slug', '=', $slug)->first();
        $category = articlecategories::all();
        $articles = article::all();
        if ($article->status == "Draft")
        {
            if (!Auth::user()->isSuperAdmin())
            {
                return redirect()->route('userarticles.index')->with('article', $articles)->with('category', $category)->with('error', 'This Article is unavailable');
            }
        }
    	return view('articles.show')->with('article', $article);

    }
}
