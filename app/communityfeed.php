<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class communityfeed extends Model
{
    protected $table = 'communityfeed';
    protected $primaryKey = 'threadID';
    protected $fillable = ['threadTitle', 'threadContent', 'slug', 'categoryID', 'userID'];
    public $timestamps = false;

    public function replies()
    {
       return $this->hasMany('App\replies', 'threadID');
    }

    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }
    public function category()
    {
        return $this->belongsTo('App\threadcategories', 'categoryID');
    }
}
