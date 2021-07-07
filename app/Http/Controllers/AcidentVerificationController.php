<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcidentVerification; //this is a model
use Illuminate\Support\Facades\Validator;


// use APP\Models\AcidentVerification;

class AcidentVerificationController extends Controller
{
    public function index()
    {
        $accident = AcidentVerification::with(['insuarance'])->get();
        return response()->json($accident);
    }
    public function store(Request $request)
    {
        $customer = AcidentVerification::where('platenumber', $request['platenumber'])->first();

        $accident = new AcidentVerification();

        $accident->platenumber = $request->input('platenumber');
        $accident->typeofacident = $request->input('typeofacident');
        $accident->policeReportNo = $request->input('policeReportNo');
        // $accident->image1 = $request->input('image1');
        $compFileName = $request->file('image1')->getClientOriginalName();
        $fileNameOnly = pathinfo($compFileName, PATHINFO_FILENAME);
        $extension = $request->file('image1')->getClientOriginalExtension();
        $compPict = str_replace(' ', '_', $fileNameOnly) . rand() . '.' . $extension;
        $path = $request->file('image1')->storeAs('public/images', $compPict);
        $accident->image1 = $compPict;
        // $accident->image2 = $request->input('image2');
        $compFileName = $request->file('image2')->getClientOriginalName();
        $fileNameOnly = pathinfo($compFileName, PATHINFO_FILENAME);
        $extension = $request->file('image2')->getClientOriginalExtension();
        $compPict = str_replace(' ', '_', $fileNameOnly) . rand() . '.' . $extension;
        $path = $request->file('image2')->storeAs('public/images', $compPict);
        $accident->image2 = $compPict;
        // $accident->image3 = $request->input('image2');
        $compFileName = $request->file('image3')->getClientOriginalName();
        $fileNameOnly = pathinfo($compFileName, PATHINFO_FILENAME);
        $extension = $request->file('image3')->getClientOriginalExtension();
        $compPict = str_replace(' ', '_', $fileNameOnly) . rand() . '.' . $extension;
        $path = $request->file('image3')->storeAs('public/images', $compPict);
        $accident->image3 = $compPict;

        $accident->create_by = $request->input('create_by');
        if ($customer) {
            return response()->json([
                'error' => true,
                'message' => '
          Please check customer is already Payed'
            ], 200);
        }

        $accident->save();

        return response()->json([
            'accident' => $accident,
        ], 200);
        //  }
        // }
    }

    public function show($acidentid)
    {
        return response()->json([
            'acident' => AcidentVerification::find($acidentid),
        ], 200);
    }

    public function update(Request $request, $acidentid)
    {

        //$agents = Customer::find($agentid);
        $accident = AcidentVerification::find($acidentid);

        $accident->platenumber = $request->input('platenumber');
        $accident->typeofacident = $request->input('typeofacident');
        $accident->policeReportNo = $request->input('policeReportNo');
        $accident->create_by = $request->input('create_by');
        $accident->save();

        return response()->json([
            'acident' => $accident,
        ], 200);
    }

    public function destroy($acidentid)
    {
        $acident = AcidentVerification::findOrFail($acidentid);
        $acident->delete();
        if ($acident) {
            return response()->json([
                'message' => 'Deleted!'
            ], 200);
        } else {
            return response()->json(null, 204);
        }
    }

    // end
}
