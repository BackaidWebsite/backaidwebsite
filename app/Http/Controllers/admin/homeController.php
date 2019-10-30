<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\faq;
use App\roles;
use App\User;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

}
