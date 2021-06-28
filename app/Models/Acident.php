<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acident extends Model
{
    use HasFactory;
    protected $table = 'acident';
    public $timestamps = false;
    protected $primaryKey = 'acidentid';
    protected $fillable = [
        'platenumber',
        'typeofacident',
        'policeReportNo',
        'image1',
        'image2',
        'image3',
        'create_by',
    ];
}
