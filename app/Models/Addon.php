<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Addon extends Model
{
    use HasTranslations;
    protected $table = 'addons';

    protected $guarded =[];

    public $translatable = ['name'];

    public function menu() {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
