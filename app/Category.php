<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];
    
    public function quizzes()
    {
        return $this->hasMany('EVOS\Quiz');
    }
}
