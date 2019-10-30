<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\faq;
use App\roles;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('user', $users);
    }

    public function create()
    {
       return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $this->validate ($request, [
            'name' => ['required', 'string', 'min:3', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $pass = Hash::make("password");
        $user->password = $pass;
        $user->save();
        $user->roles()->attach(roles::where('name', 'User')->first());
        return redirect('admin/users')->with('success', 'User Created');
     }

     public function update(Request $request, $userID)
     {
         $user= User::find($userID);
         $this->validate ($request, [
             'name' => ['required', 'string', 'min:3', 'max:15', 'unique:users'],
         ]);

         $user->name = $request->input('name');
         $user->save();
         return redirect('admin/users')->with('success', 'User Updated');
      }

    public function destroy($userID) {

        $user= User::find($userID);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted');
    }

}
