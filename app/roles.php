<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'rolesID';
    protected $fillable = ['roles'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'useroles', 'rolesID', 'userID');
    }
}
