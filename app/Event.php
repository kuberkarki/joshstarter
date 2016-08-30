<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
   // use SoftDeletes;
    use Taggable;
    use Sluggable;
    protected $table = 'events';

    //protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
     /**
     * Sluggable configuration.
     *
     * @var array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source'         => 'name',
                'separator'      => '-',
                'includeTrashed' => true,
            ]
        ];
    }

    public function comments()
    {
        return $this->hasMany('App\EventComment');
    }

}