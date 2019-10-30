<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class useroles extends Model
{
    protected $table = 'useroles';
    protected $fillable = ['userID', 'rolesID'];
    public $timestamps = false;

}
