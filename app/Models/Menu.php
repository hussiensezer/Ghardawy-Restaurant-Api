<?php

namespace App\Models;

use App\Abstracts\UnicodeModel;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Menu extends UnicodeModel
{
    use HasTranslations;
    protected $table = 'menus';
    protected $guarded = [];

    public $timestamps = true;

    public $translatable = ['name', 'description'];

    public function addOn(){
        return $this->hasMany(Addon::class, 'menu_id', 'id');
    }

    public function menuPriceSize() {
        return $this->hasMany(MenuPriceSize::class, 'menu_id', 'id');
    }// End Menu PriceSize


}
