<?php 
namespace App\Models\Ride;

use Config;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ride\GenerateBookingNo;


class Rides extends Model{
    
    protected $table = 'Rides';
    protected $primaryKey = 'RideId';
    public $timestamps = false, $props = [];
    protected $fillable = ['BookingId', 'Source_Name', 'Source_latitude', 'Source_longitude',
    'Destination_Name', 'Destination_latitude', 'Destination_longitude', 'BookedDate',
    'TotalAmount', 'ApplicableAmount', 'PaymentStatus', 'PaidAmount','PendingAmount',
    'RefundAmount','ConsumedAmount','TaxCalculationDetails','RideStatus','UserID', 
    'UserType', 'TripTypeId', 'VehicleTypeId', 'VehicleId', 'IsCorporateBooking', 'CorporateBookingReasonId',
    'CorporateBookingReason','NoOfTrips','BookingType', 'BookedFrom'];

    public function RideId(){
        return $this->hasMany(AssociateRides::class, 'RideId');
    }

    public function getBookingId(){
        $obj = new GenerateBookingNo();
        $obj->save();
        return getBookingNo($obj->BookingNo);
    }

    public function getSourceName(){
        return isset($this->props['Source']['Name'])?$this->props['Source']['Name']:'';
    }

    function getSourceLatititue(){
        return isset($this->props['Source']['Latitude'])?$this->props['Source']['Latitude']:'';
    }

    function getSourceLongitude(){
        return isset($this->props['Source']['Longitude'])?$this->props['Source']['Longitude']:'';
    }

    function getDestinationName(){
        return  isset($this->props['Destination']['Name'])?$this->props['Destination']['Name']:'';
    }

    function getDestinationLatitude(){
        return isset($this->props['Destination']['Latitude'])?$this->props['Destination']['Latitude']:'';
    }

    function getDestinationLongitude(){
        return isset($this->props['Destination']['Longitude'])?$this->props['Destination']['Longitude']:'';
    }

    function getTotalAmount(){
        return $this->props['TotalAmount'];
    }

    function getUserID(){
        return $this->props['User']->UserID;
    }

    function getVehicleId(){
        return $this->props['Vehicle']['VehicleId'];
    }

} 