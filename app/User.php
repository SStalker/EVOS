<?php

namespace EVOS;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function categories()
    {
        return $this->hasMany('EVOS\Category');
    }

    public function shares()
    {
        return $this->hasMany('EVOS\Share');
    }

    public function rootCategories()
    {
        return $this->hasMany('EVOS\Category')->where('parent_id', '=', '0')->get();
    }
}
