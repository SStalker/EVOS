<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Baum\Node;

class Category extends Node
{
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'user_id', 'parent_id'];

    protected $orderColumn = 'title';
    
    public function quizzes()
    {
        return $this->hasMany('EVOS\Quiz');
    }

    public function user()
    {
        return $this->belongsTo('EVOS\User');
    }

    public function parent()
    {
        return $this->belongsTo('EVOS\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('EVOS\Category', 'parent_id');
    }

    public function quizzesWithoutShares() {
        return $this->quizzes()->withoutShares()->get();
    }
}
