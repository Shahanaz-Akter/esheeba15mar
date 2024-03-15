<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'phone', 'name', 'email', 'image', 'date_of_birth', 'sex', 'blood_group', 'created_at' ,'service_area', 'address'
    ];


    public function client(){
        return $this->belongsTo('App\User', 'phone', 'phone');  
    }

    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
}
