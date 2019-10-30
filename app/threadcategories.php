<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class threadcategories extends Model
{
    protected $table = 'threadcategories';
    protected $primaryKey = 'categoryID';
    protected $fillable = ['category', 'slug'];
    public $timestamps = false;

    public function thread()
    {
        return $this->hasMany('App\communityfeed', 'categoryID');
    }
}
