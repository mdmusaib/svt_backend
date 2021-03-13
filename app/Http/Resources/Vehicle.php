<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
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
            'vehicle_no'=>$this->vehicle_no,
            'vehicle_provider'=>$this->vehicle_provider,
            'service_loc'=>$this->service_loc,
            'transport_type'=>$this->transport_type,
            'vehicle_details'=>$this->vehicle_details,
            'permit'=>$this->permit,
            'permit_expiry_date'=>$this->permit_expiry_date,
        ];
    }
}
