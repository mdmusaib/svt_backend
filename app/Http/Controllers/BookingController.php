<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse; 
use Illuminate\Http\Request;
use App\Booking;
use App\Vehicle;
use App\Http\Resources\Booking as BookingResource;
class BookingController extends Controller
{
    public function index()

    {
        $bookings=Booking::all();
        return BookingResource::collection($bookings);
    }
    public function create(Request $request){
        
        $input = $request->data;
        $validator = Validator::make($input, [
            'customer_type' => 'required',
            'sender_mobile' => 'required',
            'sender_origin' => 'required',
            'receiver_name' => 'required',
            'receiver_mobile' => 'required',
            'receiver_address' => 'required',
            'items' => 'required',
            'total_weight' => 'required',
            'rate' => 'required',
            'date' => 'required',
            'total_amount' => 'required',
            'vehicle_details'=>'required'
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

        $booking = Booking::create($input);
        
        if($booking){
            $vehicle_data=json_decode($input['vehicle_details']);
            foreach ($vehicle_data as $vehicles) {
            $newVehicle=new Vehicle();
            $newVehicle->fill([
                "booking_id"=>$booking->id,
                "vehicle_no"=>$vehicles->vehicle_no,
                "from_loc"=>$vehicles->from_loc,
                "to_loc"=>$vehicles->to_loc,
                "material"=>$vehicles->material,
                "party_name"=>$vehicles->party_name,
                "rate"=>$vehicles->rate,
                "scale"=>$vehicles->scale,
                "total_amount"=>$vehicles->total_amount,
                "expences"=>$vehicles->expences,
                "driver_name"=>$vehicles->driver_name,
                "profit"=>$vehicles->profit
            ]);
            $newVehicle->save();     
            }    
    }

    return response()->json(['status'=>1,'response' => $booking]);
    }
    public function show(Request $request,$id){
        $bookings=Booking::find($id);

        if(is_null($id)){
                 return response()->json(['status'=>1,'response' => '404!No Information Found In Our Record!']);
        }



        return new BookingResource($bookings);

    }
    public function update(Request $request,$id){
        $updateBooking=Booking::findorfail($id);
        $updateBooking->update($request->all());
        return new BookingResource($updateBooking);

    }
}
