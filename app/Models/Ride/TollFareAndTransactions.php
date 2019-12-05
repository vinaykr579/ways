<?php
namespace App\Models\Ride;

use Illuminate\Database\Eloquent\Model;

class TollFareAndTransactions extends Model{
    protected $table = 'TollFareAndTransactions';
    protected $primaryKey = 'TollFareAndTransactionId';
    public $timestamps = false, $props = [];

    protected $fillable = ['EntryId','VoucherNo','FlowType', 
    'AccountName', 'TransactionId', 'TollId', 'VehicleId',
     'UserId', 'Amount','IdentityType'];
     
    function getAccountName(){
        if($this->props['FlowType'] == 1){
            return $this->props['DebitAccount'];
        }else{
            return $this->props['CreditAccount'];
        }
    }
    
    function getTransactionId(){
        return isset($this->props['transaction']->TransactionId)?$this->props['transaction']->TransactionId:0;
    }

    function getTollId(){
        return 0;
    }

    function getVehicleId(){
        return isset($this->props['ride']->VehicleId)?$this->props['ride']->VehicleId:0;
    }

    function getUserId(){
        return 0;
    }

    function getIdentityType(){
        return $this->props['identityType'];
    }
}
