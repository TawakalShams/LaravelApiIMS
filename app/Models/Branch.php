<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    function agent()
    {
        return $this->belongsTo('App\Agent');
    }
}
