<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['question', 'answerA', 'answerB', 'answerC', 'answerD', 'countdown'];

    public function quiz()
    {
        return $this->belongsTo('EVOS\Quiz');
    }

    public function category()
    {
        return $this->belongsTo('EVOS\Category');
    }

    public function attendees()
    {
        return $this->hasMany('EVOS\Attendee');
    }
}
