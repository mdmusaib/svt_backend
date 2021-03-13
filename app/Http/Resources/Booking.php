<?php

namespace App\Http\Resources;
use App\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class Booking extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            'customer_name'=>$this->receiver_name,
            'receiver_address'=>$this->receiver_address,
            'gst'=>$this->gst,
            'items'=>$this->items,
            'total_weight'=>$this->total_weight,
            'rate'=>$this->rate,
            'date'=>$this->date,
            'delivery_date'=>$this->delivery_date,
            'tax'=>$this->tax,
            'total_amount'=>$this->total_amount,
            "vehicle_details"=>Vehicle::where('booking_id','=',$this->id)->get(),
        ];
    }
}
