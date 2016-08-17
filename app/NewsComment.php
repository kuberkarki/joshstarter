<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'news_comments';

    protected $guarded = ['id'];

    public function news()
    {
        return $this->belongsTo('App\News');
    }

}