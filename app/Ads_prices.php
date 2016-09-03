<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads_prices extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'ads_prices';

    protected $guarded = ['id'];

    public function ad()
    {
        return $this->hasMany('App\Ad');
    }
}
