<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class profileController extends Controller
{

    public function index()
    {
        $user = User::where('userID', '=', Auth::user()->userID)->first();
        return view('profile.index')->with('user', $user);
    }
    public function update(Request $request, $userID)
    {
        $user = User::find($userID);
        if ($request->input('status') == "details")
        {
            if (($request->input('email') == $user->email) and ($request->input('name') == $user->name))
            {

            }
            if ($request->input('name') == $user->name)
            {
                $this->validate ($request, [
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
                $user->email = $request->input('email');
                $user->save();
            }
            else if ($request->input('email') == $user->email)
            {
                $this->validate ($request, [
                    'name' => ['required', 'string', 'min:2', 'max:15'],
                ]);
                $user->name = $request->input('name');
                $user->save();
            }
            return redirect()->route('profile.index')->with('success', 'Account Profile Updated');
        }
        else if ($request->input('status') == "pass")
        {
            $validator = Validator::make($request->all(), [
                'oldPassword' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('Old password didn\'t match');
                        }
                    },
                ],
                'password' => ['required', 'string', 'min:8','max:255', 'confirmed','different:oldPassword'],
            ],
            [
                'password.required' => 'The new password field is required.',
                'password.min' => 'The new password field must be atleast 8 characters.',
                'password.max' => 'The new password field may not be greater than 255 characters.',
            ]);
            if ($validator->fails())
            {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $user->password = Hash::make($request->input('password'));
            $user->save();
            Auth::login($user);


            return redirect()->route('profile.index')->with('success', 'Password Updated');
        }
    }
}
