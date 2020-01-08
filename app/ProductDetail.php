<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    protected $guarded = [];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
