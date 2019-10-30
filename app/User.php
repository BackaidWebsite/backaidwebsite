<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
protected $table = 'users';
protected $primaryKey = 'userID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    public function articles()
    {
       return $this->hasMany('App\article' , 'userID');
    }

    public function articlecomment()
    {
       return $this->hasMany('App\articlecomment', 'userID');
    }

    public function faq()
    {
       return $this->hasMany('App\faq', 'userID');
    }

    public function threads()
    {
       return $this->hasMany('App\communityfeed', 'userID');
    }

    public function replies()
    {
       return $this->hasMany('App\replies', 'userID');
    }

    public function roles()
   {
       return $this->belongsToMany('App\roles', 'useroles', 'userID', 'rolesID');
   }

   public function isSuperAdmin()
   {
       return $this->roles()->where('name', 'Admin')->exists();
   }

   public function isUser()
   {
       return $this->roles()->where('name', 'User')->exists();
   }

   public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }


    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

}
