<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Cviebrock\EloquentSluggable\Sluggable;
use willvincent\Rateable\Rateable;
use Tshafer\Reviewable\Contracts\Reviewable;
use Tshafer\Reviewable\Traits\Reviewable as ReviewableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Kuber\ViewCounter\ViewCounterTrait;

class Event extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
   // use SoftDeletes;
    use Taggable;
    use Sluggable;
    use Rateable;
    use ReviewableTrait;
    use SearchableTrait;
    use ViewCounterTrait;
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