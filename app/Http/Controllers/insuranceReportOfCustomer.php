<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclesModel;
use Illuminate\Support\Facades\DB;

use App\Models\Insuarance; //this is a model

class insuranceReportOfCustomer extends Controller
{
    public function show($platenumber)
    {
        return response()->json([
            'payment' =>
            DB::table('vehicles')
                ->select('*')
                ->join('customers', 'customers.platenumber', '=', 'vehicles.platenumber')
                ->join('payment', 'payment.customerid', '=', 'customers.customerid')
                ->join('insuarance', 'insuarance.platenumber', '=', 'vehicles.platenumber')
                ->get()
        ], 200);
    }
}
