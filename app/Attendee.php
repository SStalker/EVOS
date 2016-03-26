<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = ['name', 'session_token', 'quiz_id'];

    public function questions()
    {
        return $this->hasMany('EVOS\Question');
    }

    public function quiz()
    {
        return $this->belongsTo('EVOS\Quiz');
    }
}
