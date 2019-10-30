<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments_replies extends Model
{
    protected $table = 'comments_replies';
    protected $primaryKey = 'id';
    protected $fillable = ['reply','commentID','userID'];
    public $timestamps = false;


    public function articlecomment()
    {
        return $this->belongsTo('App\articlecomment' , 'commentID');
    }

    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }

}
