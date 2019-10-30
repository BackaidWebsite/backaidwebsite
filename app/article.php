<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'articleID';
    protected $fillable = ['articleTitle', 'articleContent', 'status', 'slug', 'categoryID', 'userID'];
    public $timestamps = false;



    public function user()
    {
        return $this->belongsTo('App\user' , 'userID');
    }

    public function category()
    {
        return $this->belongsTo('App\articlecategories' , 'categoryID');
    }

    public function comment()
    {
       return $this->hasMany('App\articlecomment', 'articleID');
    }
}
