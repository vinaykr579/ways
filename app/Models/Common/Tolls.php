<?php
namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class Tolls extends Model{
    
    protected $table = 'Tolls';
    protected $primaryKey = 'TollId';
    public $timestamps = false;

    protected $hidden = [
        'EmailId', 'LandlineNumber', 'NHNumber', 'MinBleedOffAmountAllowed',
         'StateId','AddressId', 'Default_PaymentInfo_id', 'EffectiveDate', 'TollOwnerId',
         'ContactPersonId','LaneInDescription','LaneIn_Latitude','LaneIn_Longitude','LaneOutDescription',
         'LaneOut_Latitude','LaneOut_Longitude', 'IsApplicable', 'CreatedOnDate','UpdatedOnDate'
    ];
}