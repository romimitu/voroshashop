<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $guarded = [];


    public function color()
    {
        return $this->hasOne('App\Color', 'color_id');
    }
}
