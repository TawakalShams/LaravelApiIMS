<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerPaymentModel;

class Insuarance extends Model
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
        return $this->hasOne(CustomerPaymentModel::class, 'insuaranceid');
    }
}
