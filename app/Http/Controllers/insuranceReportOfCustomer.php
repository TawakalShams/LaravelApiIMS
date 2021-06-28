<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclesModel;
use Illuminate\Support\Facades\DB;
use App\Models\Insuarance; //this is a model

class insuranceReportOfCustomer extends Controller
{
    public function show($vehicleId)
    {
        $insurances = VehiclesModel::with(['insurances', 'customers', 'payments'])->findOrFail($vehicleId);
        return response()->json($insurances);
    }
}
