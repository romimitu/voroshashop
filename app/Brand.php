<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $guarded = [];


    public function brand()
    {
        return $this->hasOne('App\Brand', 'brand_id');
    }
}
