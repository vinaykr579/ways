<?php
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;

class PaymentInfos extends Model{
    protected $table = 'PaymentInfos';
    protected $primaryKey = 'PaymentInfoId';
    public $timestamps = false, $props = [];
    protected $fillable = ['PaymentModeId', 'UserId', 'IdentityType', 'AccountNumber', 'Expire_mm',
     'Expire_yy', 'CVV', 'AccountHolderName', 'BankName', 'IFSCode', 'IsActive'];

    
    function getUserId(){
        return $this->props['User']->UserID;
    } 

    function getAccountNumber(){
        return $this->props['PaymentInfo']['AccountNumber'];
    }

    function getExpiryMonth(){
        return $this->props['PaymentInfo']['Expire_mm'];
    }

    function getExpiryYear(){
        return $this->props['PaymentInfo']['Expire_yy'];
    }

    function getAccountHolderName(){
        return $this->props['PaymentInfo']['AccountHolderName'];
    }
}