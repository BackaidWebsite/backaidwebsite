<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\threadcategories;
use App\communityfeed;
use App\Http\Controllers\Controller;

class threadcategoryController extends Controller
{
    public function index()
    {
        $category = threadcategories::all();
        return view('admin.threadcategories.index')->with('threadcategories', $category);
    }

    public function create()
    {
        return view('admin.threadcategories.create');
    }

    public function store(Request $request)
    {
        $this->validate ($request, [
            'category' => 'required|max:30|unique:threadcategories,category',
        ]);

       $category = new threadcategories();
       $category->category = $request->input('category');
       $cat = $request->input('category');
       $slug = str_slug($cat);
       $category->slug = $slug;

       $category->save();

       return redirect('admin/threadcategories')->with('success', 'Thread Category Created');
    }

    public function edit($categoryID)
    {
        $category = threadcategories::find($categoryID);
        return view('admin.threadcategories.edit')->withcategory($category);
    }
    public function update(Request $request, $categoryID)
    {

        $category = threadcategories::find($categoryID);
        if ($request->input('category') == $category->category)
        {
            
        }
        else
        {
            $this->validate ($request, [
                'category' => 'required|max:30|unique:threadcategories,category',
            ]);
        }
        $category->category = $request->input('category');
        $cat = $request->input('category');
        $slug = str_slug($cat);
        $category->slug = $slug;

        $category->save();

        return redirect('admin/threadcategories')->with('success', 'Thread Category Updated');
     }


    public function destroy($categoryID)
    {
        $category = threadcategories::find($categoryID);
        $threads = communityfeed::where('categoryID', $categoryID)->count();
        if ($threads > 0)
        {
            return redirect('admin/threadcategories')->with('error', 'Error: Threads exist with this category attached ');
        }
        else
        {
            $category->delete();
            return redirect('admin/threadcategories')->with('success', 'Thread Category Deleted');
        }
    }
}
