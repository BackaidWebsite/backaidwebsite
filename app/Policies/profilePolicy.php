<?php

namespace App\Policies;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class articlepolicy
{
    use HandlesAuthorization;


    public function access(User $user)
    {
        return $user->userID ==  Auth::user()->userID;
    }


}
