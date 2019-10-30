<?php

namespace App\Policies;

use App\User;
use App\communityfeed;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;


    public function access(User $user, communityfeed $communityfeed)
    {
        return $communityfeed->userID ==  $user->userID;
    }
}
