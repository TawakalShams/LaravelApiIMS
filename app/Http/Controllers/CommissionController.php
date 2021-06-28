<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Commission; //this is a model

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'commission' => Commission::all(),
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
        $commission = Commission::where('commissionid', $request['commissionid'])->first();

        if ($commission) {
            return response()->json([
                'error' => true,
                'message' => ('Id already exists')
            ], 409);
        } else {
            $validation = Validator::make($request->all(), [
                'agentid'      => 'required',
                'amount'      => 'required',
                'created_by' => 'required'
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validation->errors()
                ], 200);
            } else {
                $commission = new Commission();
                $commission->agentid = $request->input('agentid');
                $commission->amount = $request->input('amount');
                $commission->created_by = $request->input('created_by');
                $commission->save();

                return response()->json([
                    'agents' => $commission,
                ], 200);
            }
        }
    }

    public function use(Request $request)
    {
        return response()->json($request->commission());
    }
    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($commissionid)
    {
        return response()->json([
            'commission' => Commission::find($commissionid),
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
    public function update(Request $request, $agentid)
    {
        $validation = Validator::make($request->all(), [
            'agentid'   => 'required',
            'amount'    => 'required',
            'created_by' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

            //$agents = Customer::find($agentid);
            $commission = Commission::find($agentid);

            $commission->agentid = $request->input('agentid');
            $commission->amount = $request->input('amount');
            $commission->created_by = $request->input('created_by');
            $commission->save();

            return response()->json([
                'agents' => $commission,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($commissionid)
    {
        $commission = Commission::findOrFail($commissionid);
        $commission->delete();
        if ($commission) {
            return response()->json([
                'message' => 'Commission Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
