<?php

namespace Kuber\ViewCounter;

class Counter extends \Eloquent {

  protected $table = 'counter';
  protected $fillable = array('class_name', 'object_id');

}