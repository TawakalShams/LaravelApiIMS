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

        $accident = PayInsuaredModel::with(['insuarance'])->get();
        return response()->json([
            'total_balance' => $total,
            'accident' =>  $accident,

        ]);

        // return response()->json([
        //     'total_balance' => $total,
        //     // 'insuaredPay' => PayInsuaredModel::all(),
        //     'insuaredPay' =>
        //     DB::table('payinsuared')
        //         ->select('*')
        //         // ->join('insuarance', 'insuarance.insuaranceid', '=', 'payinsuared.insuaranceid')
        //         // ->join('vehicles', 'vehicles.platenumber', '=', 'insuarance.platenumber')
        //         // ->join('customers', 'customers.platenumber', '=', 'vehicles.platenumber')
        //         ->get()
        // ], 200);
    }

    public function store(Request $request)
    {


        $customer = PayInsuaredModel::where('platenumber', $request['platenumber'])->first();

        $payments = new PayInsuaredModel();

        $payments->platenumber = $request->input('platenumber');
        $payments->amount = $request->input('amount');
        $payments->status = 'PAID';
        $payments->create_by = $request->input('create_by');

        // if ($amount == 45000 && !$customer) {
        //     $payments->amount = $request->input('amount');
        // } elseif ($customer) {
        //     return response()->json([
        //         'error' => true,
        //         'message' => '
        //   Please check customer is already paid'
        //     ], 200);
        // } else {

        // if($customer){
        // return response()->json([
        //     'error' => true,
        //     'message' => ' Please check customer is already paid'
        // ], 200);
        // }
        // }
        if ($customer) {
            return response()->json([
                'error' => true,
                'message' => '
          Please check customer is already paid'
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
