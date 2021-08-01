<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //this is a model
use Illuminate\Support\Facades\DB;



class ViewAllUsers extends Controller
{
    public function index()
    {
        return response()->json([
            'agents' => User::all(),
        ], 200);
        // return response()->json([
        //     'users' =>
        //     DB::table('users')
        //         ->select('*')
        //         // ->where('role', 'Agent')
        //         ->get()
        // ], 200);
    }
}
