<?php 
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;

class TollsInRide extends Model{
    protected $table = 'TollsInRide';
    protected $primaryKey = 'TollInRideId';
    public $timestamps = false, $props = [];
    protected $fillable = ['TollId','AssociateRideId','TollFare','ApplicableFare','IsSelected',
    'LaneDirection','ExpiredOnDate','VehicleId','RideStatus','TollPaymentStatus',
    'TotalRidesCount','ConsumedCount','PaymentModeId','TollTripTypeId',
    'TollUniqueId','UnlimitedRide','Status'];

    function getExpiredOnDate(){
        return date('Y-m-d H:i:s', strtotime('+365 days', time()));
    }
}