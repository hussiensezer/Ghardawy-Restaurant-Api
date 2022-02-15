<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function ownerId() {
        return $this->belongsTo(Owner::class,'owner_id', 'id');
    }

    public function menus() {
        return $this->hasMany( Menu::class ,'place_id', 'id');
    }// End Menus
}
