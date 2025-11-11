<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $table = 'whatsapp_messages';

    protected $fillable = [
        'from' ,			
		'subject', 		
		'body' 	,		
		'pickup_date', 	
		'pickup_time' ,	
		'pickup_address',
		'destination',     		
		'press', 		
		'uname',   		
		'vehicle', 		
		'mode',  		
		'mobile',  		
		'flight_no',  	
		'remark',  		
		'price',  		
		'price1',  		
		'house_no_from', 
		'house_no_to', 
		'email', 		
		'luggage' 		
    ];

    public $timestamps = false; // omdat we zelf received_at hebben
}
