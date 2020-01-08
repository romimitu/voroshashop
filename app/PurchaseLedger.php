<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseLedger extends Model
{
    protected $guarded = [];

    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function stockLedger()
    {
        return $this->hasMany(StockLedger::class);
    }
}
