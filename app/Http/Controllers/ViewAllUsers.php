<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //this is a model


class ViewAllUsers extends Controller
{
    public function index()
    {
        return response()->json([
            'agents' => User::all(),
        ], 200);
    }
}
