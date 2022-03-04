<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Spatie\Translatable\HasTranslations;

class Place extends Model
{
    use HasTranslations;

    protected $table = 'places';

    protected $guarded = [];

    public $translatable = ['name'];

    public function categoryId() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function menuCategories() {
        return $this->hasMany(MenuCategory::class , 'place_id', 'id');
    }

    public function ownerId() {
        return $this->belongsTo(Owner::class,'owner_id', 'id');
    }

    public function menus() {
        return $this->hasMany( Menu::class ,'place_id', 'id');
    }// End Menus



    public function getThumbAttribute($value) {

        return URL::to('public/files/places/'  . $value);
    }
    public function getBannerAttribute($value) {
        return URL::to('public/files/places/'  . $value);
    }
}
