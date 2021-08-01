<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CustomerLogin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'insuarance';
    public $timestamps = false;
    protected $primaryKey = 'insuaranceid';
    protected $fillable = [
        // customer
        'fullName',
        'gender',
        'dob',
        'address',
        'phone',

        // vehicles
        'platenumber',
        'type',
        'model',
        'chassiNumber',
        'seat',
        'color',
        'yearOfManufacture',
        'value',

        'typeOfInsuarance',
        'startdate',
        'enddate',
        'created_by',
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
        'platenumber' => 'datetime',
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
            'insuaranceid' => $this->insuaranceid,
            'platenumber' => $this->platenumber,
            'fullName' => $this->fullName,
        ];
    }
}
