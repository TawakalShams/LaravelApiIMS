<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insuarance;


class CustomerPaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payment';
    public $timestamps = false;
    protected $primaryKey = 'paymentid';
    protected $fillable = [
        'paymentid',
        'amount',
        'status',
        'create_by'
    ];
    public function insuarance()
    {
        return $this->belongsTo(Insuarance::class, 'insuaranceid');
    }
}
