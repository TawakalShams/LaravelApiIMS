<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insuarance;


class PayInsuaredModel extends Model
{
    use HasFactory;

    protected $table = 'payinsuared';
    public $timestamps = false;
    protected $primaryKey = 'insuaranceid';
    protected $fillable = [
        'platenumber',
        'amount',
        'create_by',
    ];
    public function insuarance()
    {
        return $this->belongsTo(Insuarance::class, 'platenumber', 'platenumber');
    }
}
