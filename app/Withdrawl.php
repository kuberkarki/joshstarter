<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawl extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'withdrawls';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}