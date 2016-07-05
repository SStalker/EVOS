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
        'name', 'email', 'password', 'isAdmin',
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
        return $this->hasMany('EVOS\Category')->where('parent_id', '=', null)->get();
    }

    public function list_categories($categories, $depth = 0)
    {
        $data = [];

        foreach($categories as $category)
        {
            $data[] = [
                'name' => $category->title . str_repeat("--", $depth),
                'children' => $this->list_categories($category->children, $depth++),
            ];
        }

        return $data;
    }

    function toSelect($arr, $depth = 0) {

        $html = '';

        foreach ( $arr as $v ) {

            $html.= '<option>' . str_repeat("--", $depth) . $v['title'] . '</option>' . PHP_EOL;


            $html.= $this->toSelect($v->children, $depth++);


        }


        return $html;
    }

}
