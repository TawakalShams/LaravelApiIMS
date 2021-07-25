<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CustomerLogin;
use Illuminate\Http\Request;

class CustomerLoggin extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['customerlogin']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function customerlogin()
    {
        $credential = request(['platenumber', 'password']);

        if (!$token = Auth::attempt($credential)) {
            return response()->json(['error' => 'Unauthorized User'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json($token);
    }

    public function register(Request $request)
    {
        $user = CustomerLogin::Create([

            'fullName' => $request->fullName,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,

            'platenumber' => $request->platenumber,
            'type' => $request->type,
            'model' => $request->model,
            'chassiNumber' => $request->chassiNumber,
            'seat' => $request->seat,
            'color' => $request->color,
            'yearOfManufacture' => $request->yearOfManufacture,
            'value' => $request->value,

            'typeOfInsuarance' => $request->typeOfInsuarance,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'create_by' => $request->create_by,
        ]);

        return response()->json($user, 201);
    }
}
