<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclesModel;

class LoopController extends Controller
{
    // public function index()
    // {
    //     foreach (VehiclesModel::all() as $get)

    //         return array(
    //             'vehicles' => [
    //                 array(
    //                     'agentid' => $get->agentid,
    //                 ),

    //             ]
    //         );
    // }
    public function index()
    {
        // return response()->json([
        //     'vehicles' => VehiclesModel::all(),
        // ], 200);
        $results = [];

        foreach (VehiclesModel::all() as $post) {
            $results[] = [
                'vehicleid' => $post->vehicleid,
                // 'marketname' => $post->subtitle,
            ];
        }

        return ['results' => $results];
    }
}
