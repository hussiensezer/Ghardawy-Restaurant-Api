<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Caption extends Authenticatable implements JWTSubject
{
   protected $table = 'captions';
   protected $guarded = [];
    protected $hidden = [
        'password','admin_id','updated_at',
        'status',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'caption_id', 'id');
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
