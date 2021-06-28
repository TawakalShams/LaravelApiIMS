<?php

namespace App\Models;

use App\Models\Customers;
use App\Models\Insuarance;
use App\Models\CustomerPaymentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehiclesModel extends Model
{
  use HasFactory;
  protected $table = 'vehicles';
  public $timestamps = false;
  protected $primaryKey = 'platenumber';
  protected $fillable = [
    'platenumber',
    'type',
    'model',
    'chassiNumber',
    'seat',
    'color',
    'yearOfManufacture',
    'value',
    'created_by',
  ];

  public function insurances()
  {
    return $this->hasOne(Insuarance::class, 'vehicleid');
  }

  public function customers()
  {
    return $this->hasOne(Customers::class, 'platenumber');
    // return $this->hasOne(Customers::class, 'vehicleid');
  }
  public function payments()
  {
    return $this->hasOne(CustomerPaymentModel::class, 'customerid');
  }
}
