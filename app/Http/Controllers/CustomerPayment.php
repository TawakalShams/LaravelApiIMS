<?php

namespace App\Http\Controllers;

use App\Models\CustomerPaymentModel; //this is a model
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerPayment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = CustomerPaymentModel::sum('amount');

        return response()->json([
            'total_balance' => $total,
            'payment' =>
            DB::table('payment')
                ->select('*')
                ->join('customers', 'customers.customerid', '=', 'payment.customerid')
                ->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $customer = CustomerPaymentModel::where('customerid', $request['customerid'])->first();

        $payments = new CustomerPaymentModel();

        $payments->customerid = $request->input('customerid');
        $payments->amount = $request->input('amount');
        $payments->status = "PAID";
        $payments->create_by = $request->input('create_by');
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

    public function use(Request $request)
    {
        return response()->json($request->payments());
    }
    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($paymentId)
    {
        return response()->json([
            'payments' => CustomerPaymentModel::find($paymentId),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //  echo "Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $paymentId)

    {

        //$agents = Customer::find($agentid);
        $payments = CustomerPaymentModel::find($paymentId);
        //    $payments = new CustomerPaymentModel();

        $payments->customerid = $request->input('customerid');
        $amount = $payments->amount = $request->input('amount');

        if ($amount == 50400) {
            $payments->amount = $request->input('amount');
        } else {
            return response()->json([
                'error' => true,
                // 'message' => 'Amount to pay must be 50400'
            ], 200);
        }

        $payments->create_by = $request->input('create_by');
        $payments->save();

        return response()->json([
            'payment' => $payments,
        ], 200);
        // $validation = Validator::make($request->all(), [
        //     'customerid'  => 'required',
        //     'amount'      => 'required',
        // ]);

        // if ($validation->fails()) {
        //     return response()->json([
        //         'error' => true,
        //         'messages'  => $validation->errors(),
        //     ], 200);
        // } else {

        //     //$agents = Customer::find($agentid);
        //     $payments = CustomerPaymentModel::find($paymentId);

        //     $payments->customerid = $request->input('customerid');
        //     $payments->amount = $request->input('amount');
        //     $payments->created_by = $request->input('create_by');
        //     $payments->save();

        //     return response()->json([
        //         'payments' => $payments,
        //     ], 200);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($paymentId)
    {
        $payments = CustomerPaymentModel::findOrFail($paymentId);
        $payments->delete();
        if ($payments) {
            return response()->json([
                'message' => 'Payemnt Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
