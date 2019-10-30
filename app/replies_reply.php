<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replies_reply extends Model
{
    protected $table = 'replies_reply';
    protected $primaryKey = 'id';
    protected $fillable = ['reply','repliesID','userID'];
    public $timestamps = false;

    public function replies()
    {
    	return $this->belongsTo('App\replies', 'repliesID');
    }

    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }
}
