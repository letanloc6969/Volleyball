<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function productSize()
    {
        return $this
            ->belongsToMany(ProductSize::class, 'order_products', 'order_id', 'productsize_id')
            ->withTimestamps();
    }
}
