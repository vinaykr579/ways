<?php
namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class EmailVerifications extends Model{
    
    protected $table = 'EmailVerifications';
    protected $primaryKey = 'VerificationId';
    public $timestamps = false;

    protected $fillable = [
        'EmailId', 'UserId', 'VerificationCode', 'Status'
    ];
}