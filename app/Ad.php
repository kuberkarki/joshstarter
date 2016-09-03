<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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