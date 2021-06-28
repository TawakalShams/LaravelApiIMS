<?php

namespace App\Models;

use App\Models\CustomerPaymentModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    public $timestamps = false;
    protected $primaryKey = 'platenumber';
    protected $fillable = [
        'fullName',
        'gender',
        'dob',
        'address',
        'phone',
        'platenumber',
        'created_by',
    ];

    public function payment()
    {
        return $this->belongsTo(CustomerPaymentModel::class, 'customerid');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehiclesModel::class, 'platenumber');
    }
}
