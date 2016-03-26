<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'category_id', 'title'];

    public function questions()
    {
        return $this->hasMany('EVOS\Question');
    }

    public function attendees()
    {
        return $this->hasMany('EVOS\Attendee');
    }

    public function user()
    {
        return $this->belongsTo('EVOS\User');
    }
}
