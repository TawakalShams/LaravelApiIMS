<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Insuarance;

class AcidentVerification extends Model
{
    use HasFactory;
    protected $table = 'acident_verifications';
    // public    $primarykey='agentid';
    public $timestamps = false;
    protected $primaryKey = 'acidentid';
    protected $fillable = [
        'platenumber',
        'typeofacident',
        'policeReportNo',
        'image1',
        'image2',
        'image3',
        'created_by',
    ];

    public function insuarance()
    {
        return $this->belongsTo(Insuarance::class, 'platenumber', 'platenumber');
    }
}
