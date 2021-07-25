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

        $insuarance = Insuarance::with(['payment'])->get();
        return response()->json($insuarance);
        // return response()->json([
        //     'insuarance' =>
        //     DB::table('insuarance')
        //         ->select('*')
        //         // ->join('vehicles', 'vehicles.platenumber', '=', 'insuarance.platenumber')
        //         ->get()
        // ], 200);
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
        $agents = Insuarance::where('platenumber', $request['platenumber'])->first();

        if ($agents) {
            return response()->json([
                'error' => true,
                'message' => ('Platenumber already exists')
            ], 409);
        } else {
            $validation = Validator::make($request->all(), [
                // customer
                'fullName' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'password' => 'required',
                'address' => 'required',
                'phone' => 'required',
                // vehicles
                'platenumber'  => 'required',
                'type' => 'required',
                'model' => 'required',
                'chassiNumber' => 'required',
                'seat' => 'required',
                'color' => 'required',
                'yearOfManufacture' => 'required',
                'value' => 'required',

                'typeOfInsuarance' => 'required',
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

                $insuarance->fullName = $request->input('fullName');
                $insuarance->gender = $request->input('gender');
                $insuarance->dob = $request->input('dob');
                $insuarance->address = $request->input('address');
                // $insuarance->password = $request->input('password');
                $insuarance->password = bcrypt($request->input('password'));

                $insuarance->phone = $request->input('phone');

                $insuarance->platenumber = $request->input('platenumber');
                $insuarance->type = $request->input('type');
                $insuarance->model = $request->input('model');
                $insuarance->chassiNumber = $request->input('chassiNumber');
                $insuarance->seat = $request->input('seat');
                $insuarance->color = $request->input('color');
                $insuarance->yearOfManufacture = $request->input('yearOfManufacture');
                $insuarance->value = $request->input('value');

                $insuarance->typeOfInsuarance = $request->input('typeOfInsuarance');
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

        $insuarance->fullName = $request->input('fullName');
        $insuarance->gender = $request->input('gender');
        $insuarance->dob = $request->input('dob');
        $insuarance->address = $request->input('address');
        $insuarance->phone = $request->input('phone');

        $insuarance->platenumber = $request->input('platenumber');
        $insuarance->type = $request->input('type');
        $insuarance->model = $request->input('model');
        $insuarance->chassiNumber = $request->input('chassiNumber');
        $insuarance->seat = $request->input('seat');
        $insuarance->color = $request->input('color');
        $insuarance->yearOfManufacture = $request->input('yearOfManufacture');
        $insuarance->value = $request->input('value');

        $insuarance->typeOfInsuarance = $request->input('typeOfInsuarance');
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
