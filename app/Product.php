<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Category','cat_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function color()
    {
        return $this->belongsTo('App\Color', 'color_id');
    }
    public function size()
    {
        return $this->belongsTo('App\Size', 'size_id');
    }
    public function stockLedger()
    {
        return $this->hasMany(StockLedger::class);
    }
}
