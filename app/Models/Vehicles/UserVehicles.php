<?php

namespace App\Models\Vehicles;
use Illuminate\Database\Eloquent\Model;

class UserVehicles extends Model{
    
    protected $table = 'UserVehicles';
    protected $primaryKey = 'UserVehicleId';
    public $timestamps = false;

    public function VehicleId(){
        return $this->belongsTo('App\Models\Vehicles\Vehicles');
    }

    public function UserId(){
        return $this->belongsTo('App\Users');
    }
}