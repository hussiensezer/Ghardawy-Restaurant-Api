<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Size extends Model
{
   use HasTranslations;

   protected $table = 'sizes';

   protected $guarded = [];

   public $translatable = ['name'];


   public function adminId() {
       return $this->belongsTo(Admin::class, 'admin_id', 'id');
   }
}
