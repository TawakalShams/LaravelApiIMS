<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ChangePassword extends Controller
{
    public function update(Request $request, $agentid)
    {

        //$agents = Customer::find($agentid);
        $password = User::find($agentid);
        $password->password = bcrypt($request->input('password'));
        $password->save();
        return response()->json([
            'password' => $password,
        ], 200);
    }
}
