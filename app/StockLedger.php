<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockLedger extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function stockmain()
    {
        return $this->belongsTo(StockInMain::class);
    }

    public function purchase()
    {
        return $this->belongsTo(PurchaseLedger::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
