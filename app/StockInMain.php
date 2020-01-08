<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInMain extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function stockLedger()
    {
        return $this->belongsTo(StockLedger::class);
    }
}
