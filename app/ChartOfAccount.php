<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $guarded = [];

    public function transact()
    {
        return $this->hasMany(Transact::class);
    }
}
