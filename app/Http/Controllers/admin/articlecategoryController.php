<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\articlecategories;
use App\article;
use App\Http\Controllers\Controller;

class articlecategoryController extends Controller
{
    public function index()
    {
        $category = articlecategories::all();
        return view('admin.articlecategories.index')->with('articlecategories', $category);
    }

    public function create()
    {
        return view('admin.articlecategories.create');
    }

    public function store(Request $request)
    {
        $this->validate ($request, [
            'category' => 'required|max:30|unique:articlecategories,category',
        ]);

       $category = new articlecategories();
       $category->category = $request->input('category');
       $cat = $request->input('category');
       $slug = str_slug($cat);
       $category->slug = $slug;

       $category->save();

       return redirect('admin/articlecategories')->with('success', 'Article Category Created');
    }

    public function edit($categoryID)
    {
        $category = articlecategories::find($categoryID);

        return view('admin.articlecategories.edit')->withcategory($category);
    }

    public function update(Request $request, $categoryID)
    {

        $category = articlecategories::find($categoryID);
        if ($request->input('category') == $category->category)
        {

        }
        else
        {
            $this->validate ($request, [
                'category' => 'required|max:30|unique:articlecategories,category',
            ]);
        }
        $category->category = $request->input('category');
        $cat = $request->input('category');
        $slug = str_slug($cat);
        $category->slug = $slug;

        $category->save();

        return redirect('admin/articlecategories')->with('success', 'Article Category Updated');
     }

    public function destroy($categoryID)
    {
        $category = articlecategories::find($categoryID);
        $articles = article::where('categoryID', $categoryID)->count();
        if ($articles > 0)
        {
            return redirect('admin/articlecategories')->with('error', 'Error: Articles exist with this category attached ');
        }
        else
        {
            $category->delete();
            return redirect('admin/articlecategories')->with('success', 'Article Category Deleted');
        }
    }
}
