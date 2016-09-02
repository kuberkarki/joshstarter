<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads_category extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function blog()
    {
        return $this->hasMany('App\Ad');
    }

}