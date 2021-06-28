<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insuarance extends Model
{
    use HasFactory;
    protected $table = 'insuarance';
    public $timestamps = false;
    protected $primaryKey = 'insuaranceid';
    protected $fillable = [
        'insuaredid',
        'platenumbe',
        'type',
        'startdate',
        'enddate',
        'created_by',
    ];
}
