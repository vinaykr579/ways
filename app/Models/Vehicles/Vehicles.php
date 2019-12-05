<?php

namespace App\Models\Vehicles;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model{
    
    protected $table = 'Vehicles';
    protected $primaryKey = 'VehicleId';
    public $timestamps = false;

    public function VehicleType(){
        return $this->belongsTo('App\Models\Vehicles\VehicleTypes');
    }
}