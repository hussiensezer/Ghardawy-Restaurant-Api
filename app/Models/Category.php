<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    protected $table = 'categories';
    protected $guarded = [];
    public $timestamps = true;

    public $translatable = ['name'];

    public function adminId() {
        return $this->belongsTo(Admin::class,'admin_id', 'id');
    }
}
