<?php

namespace App\Models\Vehicles;
use Illuminate\Database\Eloquent\Model;

class VehicleTypes extends Model{
    
    protected $table = 'VehicleTypes';
    protected $primaryKey = 'TypeId';
    public $timestamps = false;

    public function TypeId(){
        return $this->hasMany('App\Models\Vehicles\Vehicles');
    }
}