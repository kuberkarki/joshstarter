<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_anouncement extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_anouncements';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function parent() {
    return $this->belongsToOne(static::class, 'parent_id');
  }

  //each category might have multiple children
  public function children() {
    return $this->hasMany(static::class, 'parent_id');
  }

}