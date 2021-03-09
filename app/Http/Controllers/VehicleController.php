<?php

namespace App\Http\Controllers;

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
