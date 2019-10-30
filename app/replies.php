<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replies extends Model
{
    protected $table = 'replies';
    protected $primaryKey = 'repliesID';
    protected $fillable = ['reply', 'parentID', 'threadID', 'userID'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }

    public function thread()
    {
        return $this->belongsTo('App\communityfeed', 'threadID');
    }

    public function replies()
    {
    	return $this->hasMany('App\replies_reply', 'repliesID');
    }
}
