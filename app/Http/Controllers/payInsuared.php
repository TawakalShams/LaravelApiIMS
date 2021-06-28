<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayInsuaredModel;
use Illuminate\Support\Facades\DB;

class PayInsuared extends Controller
{
    public function index()
    {
        $total = PayInsuaredModel::sum('amount');

        return response()->json([
            'total_balance' => $total,
            // 'insuaredPay' => PayInsuaredModel::all(),
            'insuaredPay' =>
            DB::table('payinsuared')
                ->select('*')
                ->join('insuarance', 'insuarance.insuaranceid', '=', 'payinsuared.insuaranceid')
                ->join('vehicles', 'vehicles.vehicleid', '=', 'insuarance.vehicleid')
                ->join('customers', 'customers.platenumber', '=', 'vehicles.platenumber')
                ->get()
        ], 200);
    }

    public function store(Request $request)
    {


        $customer = PayInsuaredModel::where('insuaranceid', $request['insuaranceid'])->first();

        $payments = new PayInsuaredModel();

        $payments->insuaranceid = $request->input('insuaranceid');
        $amount = $payments->amount = $request->input('amount');
        $payments->create_by = $request->input('create_by');

        if ($amount == 45000 && !$customer) {
            $payments->amount = $request->input('amount');
        } elseif ($customer) {
            return response()->json([
                'error' => true,
                'message' => '
          Please check customer is already paid'
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Amount is not correct either is maximum or minmum'
            ], 200);
        }

        $payments->save();

        return response()->json([
            'payment' => $payments,
        ], 200);
        //  }
        // }
    }
}