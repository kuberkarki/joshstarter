<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use willvincent\Rateable\Rateable;
use Tshafer\Reviewable\Contracts\Reviewable;
use Tshafer\Reviewable\Traits\Reviewable as ReviewableTrait;

class Ad extends Model  {
    use Sluggable;
    use Rateable;
    use ReviewableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads';

    protected $sluggable = [
        'build_from' => 'title',
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
                'source'         => 'title',
                'separator'      => '-',
                'includeTrashed' => true,
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Ads_category');
    }

    public function prices()
    {
        return $this->hasMany('App\Ads_prices','ads_id','id');
    }

    public function photos()
    {
        return $this->hasMany('App\Ads_photos','ads_id','id');
    }

}