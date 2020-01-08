<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $guarded = [];

    public function stockLedger()
    {
        return $this->hasMany(StockLedger::class);
    }

    public function stockInMain()
    {
        return $this->hasMany(StockInMain::class);
    }

    public function purchaseLedger()
    {
        return $this->hasMany(PurchaseLedger::class);
    }
}
