<?php

namespace EVOS;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title', 'user_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo('EVOS\User');
    }
}
