<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclesModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'vehicles' =>
            DB::table('vehicles')
                ->select('*')
            // ->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicles = new VehiclesModel();
        $vehicles->platenumber = $request->input('platenumber');
        $vehicles->type = $request->input('type');
        $vehicles->model = $request->input('model');
        $vehicles->chassiNumber = $request->input('chassiNumber');
        $vehicles->seat = $request->input('seat');
        $vehicles->color = $request->input('color');
        $vehicles->yearOfManufacture = $request->input('yearOfManufacture');
        $vehicles->value = $request->input('value');
        $vehicles->created_by = $request->input('created_by');
        $vehicles->save();

        return response()->json([
            'vehicles' => $vehicles,
        ], 200);
        // }
        // }
    }


    public function show($platenumber)
    {
        return response()->json([
            'vehicles' => VehiclesModel::find($platenumber),
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $platenumber)
    {
        $vehicles = VehiclesModel::find($platenumber);
        $vehicles->platenumber = $request->input('platenumber');
        $vehicles->type = $request->input('type');
        $vehicles->model = $request->input('model');
        $vehicles->chassiNumber = $request->input('chassiNumber');
        $vehicles->seat = $request->input('seat');
        $vehicles->color = $request->input('color');
        $vehicles->yearOfManufacture = $request->input('yearOfManufacture');
        $vehicles->value = $request->input('value');
        $vehicles->created_by = $request->input('created_by');
        $vehicles->save();
        return response()->json([
            'vehicles' => $vehicles,
        ], 200);
        // }
    }


    public function destroy($platenumber)
    {
        $vehicles = VehiclesModel::findOrFail($platenumber);
        $vehicles->delete();
        if ($vehicles) {
            return response()->json([
                'message' => 'vehicle Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
