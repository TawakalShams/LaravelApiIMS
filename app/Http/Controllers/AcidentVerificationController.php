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
        $accident = AcidentVerification::with(['insuarance', 'payinsuared'])->get();
        return response()->json($accident);
    }

    public function store(Request $request)
    {
        $customer = AcidentVerification::where('platenumber', $request['platenumber'])->first();

        $accident = new AcidentVerification();

        $accident->platenumber = $request->input('platenumber');
        $accident->typeofacident = $request->input('typeofacident');
        $accident->policeReportNo = $request->input('policeReportNo');
        $accident->create_by = $request->input('create_by');



        // if ($request->hasFile('image1')) {
        //     $compFileName = $request->file('image1')->getClientOriginalName();
        //     $fileNameOnly = pathinfo($compFileName, PATHINFO_FILENAME);
        //     $extension = $request->file('image1')->getClientOriginalExtension();
        //     $compPict = str_replace(' ', '_', $fileNameOnly) . rand() . '.' . $extension;
        //     $path = $request->file('image1')->storeAs('public/images', $compPict);
        //     $accident->image1 = $compPict;
        // }

        // if ($request->hasFile('image2')) {
        //     $compFileName2 = $request->file('image2')->getClientOriginalName();
        //     $fileNameOnly2 = pathinfo($compFileName2, PATHINFO_FILENAME);
        //     $extension2 = $request->file('image2')->getClientOriginalExtension();
        //     $compPict2 = str_replace(' ', '_', $fileNameOnly2) . rand() . '.' . $extension2;
        //     $path2 = $request->file('image2')->storeAs('public/images', $compPict2);
        //     $accident->image2 = $compPict2;

        // }
        // if ($request->hasFile('image3')) {
        //     $compFileName3 = $request->file('image3')->getClientOriginalName();
        //     $fileNameOnly3 = pathinfo($compFileName3, PATHINFO_FILENAME);
        //     $extension3 = $request->file('image3')->getClientOriginalExtension();
        //     $compPict3 = str_replace(' ', '_', $fileNameOnly3) . rand() . '.' . $extension3;
        //     $path3 = $request->file('image3')->storeAs('public/images', $compPict3);
        //     $accident->image3 = $compPict3;

        // }

        $files_path = "";

        $files = $request->file('files');
        foreach ($files as $file) {
            $files_path .= $file->store("testing") . ' ';
        }

        $accident->images = $files_path;

        // if ($customer) {
        //     return response()->json([
        //         'error' => true,
        //         'error' => '
        //   Please check customer is already Payed'
        //     ], 200);
        // }

        $accident->save();

        return response()->json([
            'accident' => $files_path,
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
