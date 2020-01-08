<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

    protected $guarded = [];

    public function product()
    {
        return $this->hasMany('App\Category', 'cat_id');
    }

    public function childs() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }
}
