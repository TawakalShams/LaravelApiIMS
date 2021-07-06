<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Agents;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Agentsresgstration; //this is a model
class Agent extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'agents' => Agentsresgstration::all(),
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
        $agents = Agentsresgstration::where('email', $request['email'])->first();

        if ($agents) {
            return response()->json([
                'error' => true,
                'message' => ('Email already exists')
            ], 409);
        } else {
            $validation = Validator::make($request->all(), [
                'fullName'   => 'required',
                'email'      => 'required',
                // 'role'       => 'required',
                'password'   => 'required',
                'gender'     => 'required',
                'dob'        => 'required',
                'address'    => 'required',
                'branch'     => 'required',
                'phone'      => 'required',
                // 'created_by' => 'required',

            ]);

            if ($validation->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validation->errors()
                ], 200);
            } else {
                $agents = new Agentsresgstration();
                $agents->fullName = $request->input('fullName');
                $agents->email = $request->input('email');
                //  $agents->role = $request->input('role');
                $agents->role = 'Agent';
                $agents->address = $request->input('address');
                $agents->password = bcrypt($request->input('password'));
                $agents->gender = $request->input('gender');
                $agents->dob = $request->input('dob');
                $agents->branch = $request->input('branch');
                $agents->phone = $request->input('phone');
                // $agents->created_by = $request->input('created_by');
                $agents->created_by = $request->input('created_by');
                $agents->save();

                return response()->json([
                    'agents' => $agents,
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
    public function show($agentid)
    {
        return response()->json([
            'agents' => Agentsresgstration::find($agentid),
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
    public function update(Request $request, $agentid)
    {
        $validation = Validator::make($request->all(), [
            'fullName'   => 'required',
            'email'      => 'required',
            'role'       => 'required',
            // 'password'   => 'required',
            'gender'     => 'required',
            'dob'        => 'required',
            'address'    => 'required',
            'branch'     => 'required',
            'phone'      => 'required',
            'created_by' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        } else {

            //$agents = Customer::find($agentid);
            $agents = Agentsresgstration::find($agentid);

            $agents->fullName = $request->input('fullName');
            $agents->email = $request->input('email');
            $agents->role = $request->input('role');
            $agents->address = $request->input('address');
            // $agents->password = $request->input('password');
            $agents->gender = $request->input('gender');
            $agents->dob = $request->input('dob');
            $agents->branch = $request->input('branch');
            $agents->phone = $request->input('phone');
            $agents->created_by = $request->input('created_by');
            $agents->save();

            return response()->json([
                'agents' => $agents,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($agentid)
    {
        $agents = Agentsresgstration::findOrFail($agentid);
        $agents->delete();
        if ($agents) {
            return response()->json([
                'message' => 'Agent Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }
}
