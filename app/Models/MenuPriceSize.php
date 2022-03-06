<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class MenuPriceSize extends Model
{
    protected $table = 'menu_price_sizes';
    protected $guarded = [];

    public function menu() {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function sizeId() {
        return $this->belongsTo(Size::class , 'size_id', 'id');
    }



}
