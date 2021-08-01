<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AndroidUserCrudModel;


class AndroidUserCrud extends Controller
{
    public function index()
    {
        return response()->json([
            'insuarnce' => AndroidUserCrudModel::all(),
        ], 200);
    }

    public function show($platenumber)
    {
        return response()->json([
            'insuarnce' => AndroidUserCrudModel::find($platenumber),
        ], 200);
    }
}
