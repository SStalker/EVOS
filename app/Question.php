<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['quiz_id','question', 'answerA', 'answerB', 'answerC', 'answerD', 'countdown'];

    public function quiz()
    {
        return $this->belongsTo('EVOS\Quiz');
    }

    public function attendees()
    {
        return $this->hasMany('EVOS\Attendee');
    }
}
