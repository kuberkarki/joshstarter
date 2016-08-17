<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'news_categories';

    protected $guarded = ['id'];

    public function news()
    {
        return $this->hasMany('App\News');
    }

}