<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Ads_category extends Model  {

    use Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_categories';

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

    public function blog()
    {
        return $this->hasMany('App\Ad');
    }

}