<?php

namespace App\Policies;

use App\User;
use App\replies_reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class Replies_replyPolicy
{
    use HandlesAuthorization;


    public function access(User $user, replies_reply $repliesReply)
    {
        return $repliesReply->userID == $user->userID;
    }
}
