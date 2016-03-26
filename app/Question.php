<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'answerA', 'answerB', 'answerC', 'answerD', 'countdown'];

    public function quiz()
    {
        return $this->belongsTo('EVOS\Quiz');
    }

    public function attendees()
    {
        return $this->hasMany('EVOS\Attendee');
    }
}
