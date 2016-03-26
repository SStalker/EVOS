<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
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
