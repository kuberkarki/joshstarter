<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventComment extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'event_comments';

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

}