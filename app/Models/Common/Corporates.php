<?php 
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class Corporates extends Model{

    protected $table = 'Corporates';
    protected $primaryKey = 'CorporateId';
    public $timestamps = false, $props = [];

    protected $fillable = ['UserId','CorporateUserId','UserRole','VerifiiedDate',
     'UpdatedByUserId', 'IsVerified', 'IsActive', 'MaximumBookingAmount'];

    public function getUserId(){
        return $this->props['adminUser']->UserID;
    }
    
    public function getCorporateUserId(){
        return $this->props['UserId'];
    }

    public function getUpdatedByUserId(){
        return $this->props['adminUser']->UserID;
    }

    public function getVerifiiedDate(){
        return date('Y-m-d H:i:s');
    }

    public function getIsVerified(){
        return '1';
    }

    public function getIsActive(){
        return '1';
    }

    
}