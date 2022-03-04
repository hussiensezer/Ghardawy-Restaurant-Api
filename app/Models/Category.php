<?php

namespace App\Models;

use App\Abstracts\UnicodeModel;
use Illuminate\Support\Facades\URL;
use Spatie\Translatable\HasTranslations;

class Category extends UnicodeModel
{
    use HasTranslations;
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = true;

    public $translatable = ['name'];

    public function adminId() {
        return $this->belongsTo(Admin::class,'admin_id', 'id');
    }

    public function getCategoryImageAttribute($value) {
        return URL::to('public/files/category/'  . $value);
    }
}
