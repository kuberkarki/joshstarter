<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'resources';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

}