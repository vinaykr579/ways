<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'Users';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    protected $fillable = [
        'Name', 'EmailId', 'Password', 'MobileNumber', 'AlternateNumber',
        'CountryCode', 'IsCorporate', 'IsEmailVerified', 'VerifiedDate', 'EmailVerifiedDate', 'IsActive', 'RegistrationStatus'
    ];

    protected $hidden = [
        'Password'
    ];

    public function routeNotificationForMail()
    {   
        return $this->EmailId;
    }

    public function routeNotificationForSMS()
    {   
        return $this->MobileNumber;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword(){
        return $this->Password;
    }
}
