<?php 
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model{

    protected $table = 'PasswordReset';
    protected $primaryKey = 'ResetId';
    public $timestamps = false;

    protected $fillable = ['EmailId', 'UserId', 'UserType', 'Token', 'IsActive'];

    

}