<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [

    	'booking_id','vehicle_no','from_loc','to_loc','material','party_name',
        'rate','scale','total_amount','expences','driver_name','profit','vehicle_provider',
        'service_loc','transport_type','vehicle_details','permit','permit_expiry_date'

    ];
}
