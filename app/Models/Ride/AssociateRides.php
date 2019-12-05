<?php
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;

class AssociateRides extends Model{
    
    protected $table = 'AssociateRides';
    protected $primaryKey = 'AssociateRideId';
    public $timestamps = false, $props = [];
    protected $fillable = ['RideId','Source_Name','Source_latitude','Source_longitude','Destination_Name',
    'Destination_latitude','Destination_longitude','EffectiveDate','ExpiryDate',
    'RideStatus','IsReturnRideId','SequenceNumber','AssociateRideUniqueId',
    'BookingSequenceNo'];

    public function RideId(){
        return $this->belongsTo(Rides::class, 'RideId');
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

}