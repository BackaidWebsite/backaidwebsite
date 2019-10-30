<?php

namespace App\Policies;

use App\User;
use App\articlecomment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentsPolicy
{
    use HandlesAuthorization;


    public function access(User $user, articlecomment $articlecomment)
    {
        return $articlecomment->userID ==  $user->userID;
    }

}
