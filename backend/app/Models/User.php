<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    protected $fillable = ['name','email','password','role_id','control_number'];
    protected $hidden = ['password'];
    public function role(){ return $this->belongsTo(Role::class); }
    public function stockMovements(){ return $this->hasMany(StockMovement::class); }

    // JWT methods
    public function getJWTIdentifier(){ return $this->getKey(); }
    public function getJWTCustomClaims(){ return []; }
}
