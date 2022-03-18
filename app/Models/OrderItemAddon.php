<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemAddon extends Model
{
   protected $table = 'order_item_addons';
    protected $guarded = [];


    public function addonId() {
        return $this->belongsTo(Addon::class, 'addon_id' , 'id');
    }
}
