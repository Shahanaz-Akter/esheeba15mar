<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{

    protected $fillable = [
        'phone', 'active', 'name', 'email', 'image', 'date_of_birth', 'sex', 'blood_group', 'service_area', 'address', 'current_work_address', 'specializes', 
    ];

    public function nurse(){
        return $this->belongsTo('App\User', 'phone', 'phone');  
    }
}
