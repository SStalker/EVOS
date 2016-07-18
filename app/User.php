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
        return Category::roots()->where('user_id', '=', $this->id)->get();
    }

    function renderNode(Category $node) {

        if( $node->children()->get()->isEmpty() ) {

                return '<li category_id="'.$node['id'].'">' . $node['title'] . '</li>';

        } else {

                $html = '<li category_id="'.$node['id'].'">' . $node['title'];
                $html .= '<ul>';

                foreach ($node['children'] as $child)
                    $html .= $this->renderNode($child);

                $html .= '</ul>';
                $html .= '</li>';

        }

        return $html;
    }

}
