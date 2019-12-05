<?php
namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model{
    
    protected $table = 'OTP';
    protected $primaryKey = 'OTPId';
    public $timestamps = false;

    protected $fillable = [
        'UserId', 'UserType', 'MobileNumber', 'OTPCode','GeneratedOn','ExpiredOn'
        , 'IsConsumed', 'Resent_date_1', 'Resent_date_2','Resent_date_3'
    ];
}