<?php

namespace App\Models;

use App\Abstracts\UnicodeModel;
use Illuminate\Support\Facades\URL;
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




    public function getImageAttribute($value) {
        return URL::to('public/files/categoryMenu/'  . $value);
    }// End Get Image Attribute;

    public function scopeOwnedBusiness($query) {
        return $query->where('place_id', auth()->user()->place->id);
    }// End ScopePlace
}
