<?php

namespace App\Policies;

use App\User;
use App\comments_replies;
use Illuminate\Auth\Access\HandlesAuthorization;

class Comments_repliesPolicy
{
    use HandlesAuthorization;


    public function access(User $user, comments_replies $commentsReplies)
    {
        return $commentsReplies->userID ==  $user->userID;
    }


}
