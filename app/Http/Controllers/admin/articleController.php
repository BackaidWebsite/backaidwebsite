<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\articlecategories;
use App\article;
use App\user;
use App\roles;
use App\articlecomment;
use Alert;
use Purifier;
use Image;
use Storage;
use App\Http\Controllers\Controller;

class articleController extends Controller
{
    public function index()
    {
        $articles = article::all();
        $categories = articlecategories::all();
        $all = "2";
        return view('admin.articles.index')->with('article', $articles)->with('categories', $categories)->with('all', $all);
    }

    public function bycategory($category)
    {
            $categories = articlecategories::all();
            $cat = articlecategories::where('slug', $category)->first();
            $articles = $cat->articles;
            $all = "1";
            return view('admin.articles.index')->with('article', $articles)->with('categories', $categories)->with('all', $all);
    }

    public function show($articleID) {

        if (!article::where('articleID', $articleID)->exists())
        {
            return redirect()->route('articles.index')->with('error', 'Article does not exist');
        }

        $article = article::find($articleID);
        return view('articles.show')->witharticle($article);
    }

    public function create()
    {
        $category = articlecategories::all();
        return view('admin.articles.create')->with('articlecategories', $category);
    }

   public function store(Request $request)
   {

       $this->validate ($request, [
           'articleTitle' => 'required|min:10|max:255|unique:article,articleTitle',
           'articleContent' => 'required',
           'category' => 'required',
           'slug' => 'required|alpha_dash|min:3|max:255|unique:article,slug',
           'featured_image' => 'sometimes|image'
       ]);

       $userId = Auth::id();
       $article = new article();
       $article->articleTitle = $request->input('articleTitle');
       $article->articleContent = Purifier::clean($request->input('articleContent'));
       $article->slug = $request->input('slug');
       if (request('status') == "Publish") {
           $article->status = "Published";
       }
       else if (request('status') == "Save as Draft")
       {
           $article->status = "Draft";
       }
       else if (request('status') == "back")
       {
           return redirect('admin/articles');
       }
       if ($request->hasFile('featured_img'))
       {
         $image = $request->file('featured_img');
         $filename = time() . '.' . $image->getClientOriginalExtension();
         $location = storage_path('images/' . $filename);
         Image::make($image->getRealPath())->resize(800, 400)->save($location);
         $oldimage = $article->image;

         $article->image = $filename;

         Storage::delete($oldimage);
       }

       $article->categoryID = $request->input('category');
       $article->userID = $userId;
       $article->save();

       return redirect('admin/articles')->with('success', 'Article Created');
    }

    public function edit($articleID) {

        $article = article::find($articleID);

        $categories = articlecategories::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->categoryID] = $category->category;
        }

        return view('admin.articles.edit')->witharticle($article)->withcategories($cats);
    }


    public function update(Request $request, $articleID)
    {

        $article = article::find($articleID);
        if (request('status') == "back")
        {
            return redirect()->route('userarticles.show', $article->slug);
        }
         if (($request->input('articleTitle') == $article->articleTitle) and ($request->input('slug') == $article->slug))
         {
             $this->validate ($request, [
                 'articleContent' => 'required',
                 'categoryID' => 'required',
                 'featured_image' => 'image'
             ]);
         }
        else if ($request->input('slug') == $article->slug)
        {
            $this->validate ($request, [
                'articleTitle' => 'required|min:10|max:255|unique:article,articleTitle',
                'articleContent' => 'required',
                'categoryID' => 'required',
                'featured_image' => 'image'
            ]);
        }
        else if ($request->input('articleTitle') == $article->articleTitle)
        {
            $this->validate ($request, [
                'articleContent' => 'required',
                'categoryID' => 'required',
                'slug' => 'required|alpha_dash|min:3|max:255|unique:article,slug',
                'featured_image' => 'image'
            ]);
        }
        else
        {
            $this->validate ($request, [
                'articleTitle' => 'required|min:10|max:255|unique:article,articleTitle',
                'articleContent' => 'required',
                'category' => 'required',
                'slug' => 'required|alpha_dash|min:3|max:255|unique:article,slug',
                'featured_image' => 'image'
            ]);
        }
        if ($request->hasFile('featured_img'))
        {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = storage_path('images/' . $filename);
          Image::make($image->getRealPath())->resize(800, 400)->save($location);
          $article->image = $filename;
        }
        $article->articleTitle = $request->input('articleTitle');
        $article->articleContent = Purifier::clean($request->input('articleContent'));
        $article->slug = $request->input('slug');

        if (request('status') == "Publish")
        {
            $article->status = "Published";
        }
        else if (request('status') == "Save Draft")
        {
            $article->status = "Draft";
        }
        else if (request('status') == "Save Changes")
        {

        }

        $article->categoryID = $request->input('categoryID');
        $article->save();

         return redirect()->route('userarticles.show', $article->slug)->with('success', 'Article Updated');
     }

     public function destroy($articleID) {

         $article = article::find($articleID);
         Storage::delete($article->image);
         $article->delete();
          return redirect('admin/articles')->with('success', 'Article Deleted');
     }
}
