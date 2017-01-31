<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model
{
	
    protected $table = 'exchanges';
    protected $guarded = ['id'];
}
