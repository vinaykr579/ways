<?php 
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;

class RideDetailRelations extends Model{
    
    protected $table = 'RideDetailRelations';
    protected $primaryKey = 'RideRelationId';
    public $timestamps = false, $props = [];
    protected $fillable = ['RideId','AssociateRideId','TollInRideId','TransactionId',
    'VehicleId','UserId','RideSequenceNo'];

    public function getRideId(){
        return $this->props['rideObj']->RideId;
    }

    public function getAssociateRideId(){
        return $this->props['aride']->AssociateRideId;
    }

    public function getTollInRideId(){
        return $this->props['tride']->AssociateRideId;
    }

    public function getTransactionId(){
        return $this->props['transObj']->TransactionId;
    }

    public function getUserId(){
        return $this->props['rideObj']->UserID;
    }

    public function getVehicleId(){
        return $this->props['rideObj']->VehicleId;
    }

    public function getRideSequenceNo(){
        return '0';
    }
}