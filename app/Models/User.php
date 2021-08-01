<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $table = "insuarance";
    protected $guard  = "users";
    protected $primaryKey = 'agentid';
    public $timestamps = false;
    protected $fillable = [
        'agentid',
        'fullName',
        'email',
        'role',
        'password',
        'gender',
        'dob',
        'platenumber',
        'address',
        'branch',
        'phone',
        'create_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
        return [
            'agentid' => $this->agentid,
            'email' => $this->email,
            'platenumber' => $this->platenumber,
            'role' => $this->role,
            'fullName' => $this->fullName,
        ];
    }
}
