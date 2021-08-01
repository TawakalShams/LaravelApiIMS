<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AndroidUserCrudModel extends Model
{
    use HasFactory;
    protected $table = 'insuarance';
    protected $primaryKey = 'platenumber';
}
