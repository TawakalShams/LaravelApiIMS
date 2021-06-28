<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VehiclesPayed extends Controller
{
    public function index()
    {
        return response()->json([
            'vehicles' =>
            DB::table('vehicles')
                ->select('*')
                ->join('customers', 'customers.platenumber', '=', 'vehicles.platenumber')
                ->join('payment', 'payment.customerid', '=', 'customers.customerid')
                ->get()
        ], 200);
    }
}
