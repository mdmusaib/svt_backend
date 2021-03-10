<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse; 
use Illuminate\Http\Request;
use App\Booking;
use App\Vehicle;
use App\Http\Resources\Vehicle as VehicleResource;
class VehicleController extends Controller
{
    public function index()

    {
        $vehicles=Vehicle::all();
        return VehicleResource::collection($vehicles);
    }
    public function update(Request $request)

    {
        $data=$request->data;
        $validator = Validator::make($request->all(), [
            'vehicle_no' => 'required',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->first();
            $errors=$validator->errors()->first();
            $code='200';
            $response = array(
                'success' => false,
                'message' => $message,
                "errors" => $errors
            );
            return new JsonResponse($response, $code);
        }
        // $validator =$request->validate([
        //     'vehicle_no' => 'required',
        // ]);
        $vehicles_details=Vehicle::where('vehicle_no',$data['vehicle_no'])->first();
            
        if($vehicles_details){
        $vehicles=Vehicle::where('vehicle_no',$data['vehicle_no'])->update($data);
        $updatedRecord=Vehicle::where('vehicle_no',$data['vehicle_no'])->first();
        
        return response()->json(['status'=>1,'response' => $updatedRecord]);  
        }else{
            $createVehicle=new Vehicle();
            $createVehicle->fill($data);
            $createVehicle->save();
            
            return response()->json(['status'=>1,'response' => $createVehicle]);  
        }
        
    }
}
