<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title'];
    
    public function quizzes()
    {
        return $this->hasMany('EVOS\Quiz');
    }
}
