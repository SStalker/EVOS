<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model
{
    protected $dates = ['deleted_at'];
    
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
