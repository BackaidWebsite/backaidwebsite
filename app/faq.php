<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faq extends Model
{
    protected $table = 'faq';
    protected $primaryKey = 'faqID';
    protected $fillable = ['question','answer','status','userID'];
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\user', 'userID');
    }
}
