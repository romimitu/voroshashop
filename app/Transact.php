<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transact extends Model
{
    protected $guarded = [];

    
    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }
}
