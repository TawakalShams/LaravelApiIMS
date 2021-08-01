<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;

class CarModelController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'car' => CarModel::all(),
        ], 200);
    }


    public function store(Request $request)
    {

        $CarModel = new CarModel();

        $CarModel->name = $request->input('name');
        $CarModel->create_by = $request->input('create_by');
        $CarModel->save();

        return response()->json([
            'CarModel' => $CarModel,
        ], 200);
    }
}
