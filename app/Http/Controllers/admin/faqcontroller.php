<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\faq;
use App\roles;
use App\User;
use App\Http\Controllers\Controller;

class faqController extends Controller
{

    public function index()
    {
        $faq = faq::all();

        return view('admin.faq.index')->with(['faq' => $faq]);

    }

    public function create()
    {
       return view('admin.faq.create');
   }

   public function store(Request $request)
   {
       if (request('status') == "back")
       {
           return redirect('admin/faq');
       }
       $this->validate ($request, [
           'question' => 'required|max:255',
           'answer' => 'required'
       ]);

       $userId = Auth::id();
       $faq = new faq();
       $faq->question = $request->input('question');
       $faq->answer = $request->input('answer');
       if (request('status') == "Publish") {
           $faq->status = "Published";
       }
       else {
           $faq->status = "Draft";
       }
       $faq->userID = $userId;
       $faq->save();

       return redirect('admin/faq')->with('success', 'FAQ Created');
    }
    public function edit($faqID) {

        $faq = faq::find($faqID);
        return view('admin.faq.edit')->with('faq',$faq);
    }


    public function update(Request $request, $faqID)
    {
        $this->validate ($request, [
            'question' => 'required|max:255',
            'answer' => 'required'
        ]);

        $faq = faq::find($faqID);
        $faq->question = $request->input('question');
        $faq->answer = $request->input('answer');
        if (request('status') == "Publish") {
            $faq->status = "Published";
        }
        else {
            $faq->status = "Draft";
        }
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'FAQ Updated');
     }

     public function destroy($faqID)
     {
         $faq = faq::find($faqID);
         $faq->delete();
         return redirect('admin/faq')->with('success', 'FAQ Deleted');
     }
}
