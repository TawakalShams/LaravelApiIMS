<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayInsuaredModel extends Model
{
    use HasFactory;

    protected $table = 'payinsuared';
    // public    $primarykey='agentid';
    public $timestamps = false;
    protected $primaryKey = 'insuaranceid';
    protected $fillable = [
        'insuaranceid',
        'amount',
        'create_by',

    ];
}
