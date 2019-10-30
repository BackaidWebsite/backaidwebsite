<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articlecategories extends Model
{
    protected $table = 'articlecategories';
    protected $primaryKey = 'categoryID';
    protected $fillable = ['category', 'slug'];
    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany('App\article' , 'categoryID');
    }
}
