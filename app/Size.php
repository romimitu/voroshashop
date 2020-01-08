<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $guarded = [];

    public function size()
    {
        return $this->hasOne('App\Size', 'size_id');
    }
}
