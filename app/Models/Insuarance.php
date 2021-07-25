<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerPaymentModel;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Insuarance extends Model
// class Insuarance extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'insuarance';
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

    public function payment()
    {
        return $this->hasOne(CustomerPaymentModel::class, 'insuaranceid', 'insuaranceid');
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'platenumber' => 'datetime',
    // ];

    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    // public function getJWTCustomClaims()
    // {
    //     return [
    //         'insuarnaceid' => $this->insuaranceid,
    //         'platenumber' => $this->platenumber,
    //         'fullName' => $this->fullName,
    //     ];
    // }
}
