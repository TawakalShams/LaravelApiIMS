<?php

namespace App\Http\Controllers;

use App\Models\Acident;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AcidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json([
            'acident' =>
            DB::table('acident')
                ->select('*')
                ->join('vehicles', 'vehicles.platenumber', '=', 'acident.platenumber')
                ->join('insuarance', 'insuarance.vehicleid', '=', 'vehicles.vehicleid')
                ->join('customers', 'customers.platenumber', '=', 'vehicles.platenumber')
                ->get()
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

        $Acident = new Acident();
        $Acident->platenumber = $request->input('platenumber');
        $Acident->typeofacident = $request->input('typeofacident');
        $Acident->create_by = $request->input('create_by');
        $Acident->save();

        return response()->json([
            'Acident' => $Acident,
        ], 200);
        // }
        // }
    }


    public function show($acidentid)
    {
        return response()->json([
            'Acident' => Acident::find($acidentid),
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $acidentid)
    {

        $Acident = Acident::find($acidentid);
        //  $vehicles->platenumber = $request->input('platenumber');
        $Acident->platenumber = $request->input('platenumber');
        $Acident->typeofacident = $request->input('typeofacident');
        $Acident->create_by = $request->input('create_by');
        $Acident->save();
        return response()->json([
            'Acident' => $Acident,
        ], 200);
        // }
    }


    public function destroy($acidentid)
    {
        $Acident = Acident::findOrFail($acidentid);
        $Acident->delete();
        if ($Acident) {
            return response()->json([
                'message' => 'Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
