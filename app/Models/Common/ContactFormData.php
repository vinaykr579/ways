<?php 
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class ContactFormData extends Model{

    protected $table = 'ContactFormData';
    protected $primaryKey = 'ContactId';
    public $timestamps = false;

    protected $fillable = ['FullName','MobileNo','EmailId','Message'];

}