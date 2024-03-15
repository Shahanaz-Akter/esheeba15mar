<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'invoice_id', 'client_id', 'nurse_id', 'appointment_date', 'service_id', 'subservice_id', 'unit_count', 'emergency', 'client_phone', 'client_address', 'appointment_status', 'rating',
    ];

    public function client(){
        return $this->belongsTo('App\Client');
    }

}
