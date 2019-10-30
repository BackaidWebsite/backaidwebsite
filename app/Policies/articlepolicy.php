<?php

namespace App\Policies;

use App\User;
use App\useroles;
use App\roles;
use App\article;
use Illuminate\Auth\Access\HandlesAuthorization;

class articlepolicy
{
    use HandlesAuthorization;


    public function access(User $user, article $article)
    {
        return $article->userID ==  $user->userID;
    }


}
