<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\faq;
use App\roles;
use App\User;
use App\Http\Controllers\Controller;

class faqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $faq = faq::all();
        return view('faq.index')->with(['faq' => $faq]);
    }
}
