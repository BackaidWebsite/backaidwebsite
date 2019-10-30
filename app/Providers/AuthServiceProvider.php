<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate;
use App\User;
use App\useroles;
use App\roles;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\articles' => 'App\Policies\articlepolicy',
         'App\articlecomment' => 'App\Policies\CommentsPolicy',
         'App\comments_replies' => 'App\Policies\Comments_repliesPolicy',
         'App\communityfeed' => 'App\Policies\ForumPolicy',
         'App\replies' => 'App\Policies\RepliesPolicy',
         'App\Replies_reply' => 'App\Policies\Replies_replyPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->before(function ($user) {

            if ($user->isSuperAdmin())
            {
                return true;
            }
        });
    }
}
