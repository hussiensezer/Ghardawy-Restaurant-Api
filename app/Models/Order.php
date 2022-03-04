<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];


    public function items() {
        return $this->hasMany(OrderItem::class , 'order_id', 'id');
    }

    public function notification() {
        return $this->hasMany( Notification::class, 'order_id', 'id');
    }

    public function placeId() {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function captionId() {
        return $this->hasOne(Caption::class, 'id', 'caption_id');
    }
}
