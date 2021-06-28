<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Insuarance; //this is a model
use Illuminate\Support\Facades\DB;


class InsuaranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json([
        //     'agents' => Insuarance::all(),
        // ], 200);


        return response()->json([

            // 'number' => rand(10000000, 99999999),
            'insuarance' =>
            DB::table('insuarance')
                ->select('*')
                // ->join('customers', 'customers.customerid', '=', 'insuarance.customerid')
                ->join('vehicles', 'vehicles.vehicleid', '=', 'insuarance.vehicleid')
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
        $agents = Insuarance::where('vehicleid', $request['vehicleid'])->first();

        if ($agents) {
            return response()->json([
                'error' => true,
                'message' => ('id already exists')
            ], 409);
        } else {
            $validation = Validator::make($request->all(), [

                'vehicleid'  => 'required',
                'color'   => 'required',
                'seat'   => 'required',
                'value'   => 'required',
                'manufacture'   => 'required',
                'startdate'   => 'required',
                'enddate'   => 'required',
                'create_by' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validation->errors()
                ], 200);
            } else {

                $insuarance = new Insuarance();
                $insuarance->vehicleid = $request->input('vehicleid');
                $insuarance->color = $request->input('color');
                $insuarance->seat = $request->input('seat');
                $insuarance->value = $request->input('value');
                $insuarance->manufacture = $request->input('manufacture');
                $insuarance->startdate = $request->input('startdate');
                $insuarance->enddate = $request->input('enddate');
                $insuarance->create_by = $request->input('create_by');
                $insuarance->save();

                return response()->json([
                    'insuarances' => $insuarance,
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
    public function show($insuaranceid)
    {
        return response()->json([
            'insuarances' => Insuarance::find($insuaranceid),
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
    public function update(Request $request, $insuaranceid)
    {

        $insuarance = Insuarance::find($insuaranceid);

        $insuarance->vehicleid = $request->input('vehicleid');
        $insuarance->color = $request->input('color');
        $insuarance->seat = $request->input('seat');
        $insuarance->value = $request->input('value');
        $insuarance->manufacture = $request->input('manufacture');
        $insuarance->startdate = $request->input('startdate');
        $insuarance->enddate = $request->input('enddate');
        $insuarance->create_by = $request->input('create_by');
        $insuarance->save();
        return response()->json([
            'insuarances' => $insuarance,
        ], 200);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($insuaranceid)
    {
        $insuarances = Insuarance::findOrFail($insuaranceid);
        $insuarances->delete();
        if ($insuarances) {
            return response()->json([
                'message' => 'Insuarance Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
