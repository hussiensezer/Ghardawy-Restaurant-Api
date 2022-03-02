<?php

namespace App\Models;

use App\Abstracts\UnicodeModel;
use Spatie\Translatable\HasTranslations;

class MenuCategory extends UnicodeModel
{
    use HasTranslations;
    protected $table = 'menu_categories';
    protected $guarded = [];
    public $translatable = ['name'];

    public $timestamps = true;

    public function items() {
        return $this->hasMany(Menu::class, 'menu_category_id', 'id');
    }// End Items

    public function place() {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }// End Place

}
