<?php

namespace App\Policies;

use App\User;
use App\replies;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepliesPolicy
{
    use HandlesAuthorization;


    public function access(User $user, replies $replies)
    {
        return $replies->userID ==  $user->userID;
    }


}
