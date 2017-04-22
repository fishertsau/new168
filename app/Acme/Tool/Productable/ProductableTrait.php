<?php


namespace Acme\Tool\Productable;

use App\Models\Product;

trait ProductableTrait
{
    public function products()
    {
        return $this->morphMany(Product::class, 'productable');
    }
}