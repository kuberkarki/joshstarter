<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use willvincent\Rateable\Rateable;
use Tshafer\Reviewable\Contracts\Reviewable;
use Tshafer\Reviewable\Traits\Reviewable as ReviewableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Kuber\ViewCounter\ViewCounterTrait;
use Sentinel;


class Ad extends Model  {
    use Sluggable;
    use Rateable;
    use ReviewableTrait;
    use SearchableTrait;
    use ViewCounterTrait;

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
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'ads.title' => 10,
            'ads.additional_ads_title' => 9,
            'ads.description' => 8,
            'ads.location' => 2,
             'ads_categories.name' => 8,
             'users.company_name' => 9,
             'users.address' => 2,
        ],
         'joins' => [
            'users' => ['ads.user_id','users.id'],
            'ads_categories' => ['ads.ads_category_id','ads_categories.id'],
        ], 
        // 'joins' => [
        //     'ads_categories' => ['ads.ads_category_id','ads_categories.id'],
        // ],
        //  'joins' => [
        //     'users' => ['ad.user_id','users.id'],
        // ],
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

    public function owner()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Ads_category','ads_category_id','id');
    }

    public function prices()
    {
        return $this->hasMany('App\Ads_prices','ads_id','id');
    }

    public function photos()
    {
        return $this->hasMany('App\Ads_photos','ads_id','id');
    }

    public function booking(){
        return $this->hasMany('App\Booking','ads_id','id');
    }

}