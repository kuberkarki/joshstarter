<?php

namespace App;

//use Cviebrock\EloquentSluggable\SluggableInterface;
//use Cviebrock\EloquentSluggable\SluggableTrait;
//use Cviebrock\EloquentTaggable\Contracts\Taggable;
use Cviebrock\EloquentTaggable\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
//use Cviebrock\EloquentTaggable\Traits\Taggable as TaggableImpl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model  {

    use SoftDeletes;
    use Taggable;
    use Sluggable;
    /*use SluggableTrait;
    use TaggableImpl;*/

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $table = 'news';

    protected $guarded = ['id'];
    /**
     * Sluggable configuration.
     *
     * @var array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'title',
                'separator'      => '-',
                'includeTrashed' => true,
            ]
        ];
    }

    public function comments()
    {
        return $this->hasMany('App\NewsComment');
    }
    public function category()
    {
        return $this->belongsTo('App\NewsCategory');
    }
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function getNewscategoryAttribute()
    {
        return $this->category->lists('id');
    }
}