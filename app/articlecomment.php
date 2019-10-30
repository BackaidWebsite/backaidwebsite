<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articlecomment extends Model
{
    protected $table = 'articlecomment';
    protected $primaryKey = 'commentID';
    protected $fillable = ['comment','articleID','userID'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }

    public function article()
    {
        return $this->belongsTo('App\article', 'articleID');
    }

    public function replies()
    {
    	return $this->hasMany('App\comments_replies', 'commentID');
    }
}
