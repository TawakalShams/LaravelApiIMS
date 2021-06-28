<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customers; //this is a model
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customers::with(['payment', 'vehicle'])->get();
        return response()->json($customers);
    }


    public function store(Request $request)
    {
        $agents = Customers::where('customerid', $request['customerid'])->first();

        if ($agents) {
            return response()->json([
                'error' => true,
                'message' => ('customer id already exists')
            ], 409);
        } else {
            $validation = Validator::make($request->all(), [
                'fullName'        => 'required',
                'gender'          => 'required',
                'dob'             => 'required',
                'address'         => 'required',
                'phone'           => 'required',
                'platenumber'     => 'required',
                'created_by'      => 'required',

            ]);

            if ($validation->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validation->errors()
                ], 200);
            } else {
                $customer = new Customers();
                $customer->fullName = $request->input('fullName');
                $customer->gender = $request->input('gender');
                $customer->dob = $request->input('dob');
                $customer->address = $request->input('address');
                $customer->phone = $request->input('phone');
                $customer->platenumber = $request->input('platenumber');
                $customer->created_by = $request->input('created_by');
                $customer->save();

                return response()->json([
                    'customer' => $customer,
                ], 200);
            }
        }
    }


    public function use(Request $request)
    {
        return response()->json($request->agent());
    }
    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customerid)
    {
        return response()->json([
            'customers' => Customers::find($customerid),
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
    public function update(Request $request, $customerid)
    {
        $validation = Validator::make($request->all(), [
            'fullName'        => 'required',
            'gender'          => 'required',
            'dob'             => 'required',
            'address'         => 'required',
            'phone'           => 'required',
            'platenumber'     => 'required',
            'created_by'      => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

            $customer = Customers::find($customerid);

            $customer->fullName = $request->input('fullName');
            $customer->gender = $request->input('gender');
            $customer->dob = $request->input('dob');
            $customer->address = $request->input('address');
            $customer->phone = $request->input('phone');
            $customer->platenumber = $request->input('platenumber');
            $customer->created_by = $request->input('created_by');
            $customer->save();

            return response()->json([
                'customers' => $customer,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerid)
    {
        $customer = Customers::findOrFail($customerid);
        $customer->delete();
        if ($customer) {
            return response()->json([
                'message' => 'Customer Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
