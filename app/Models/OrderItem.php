<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $guarded = [];

    public function AddOns() {
        return $this->hasMany(OrderItemAddon::class, 'order_item_id', 'id');
    }
}
