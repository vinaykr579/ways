<?php
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;

class GenerateBookingNo extends Model{
    
    protected $table = 'GenerateBookingNo';
    protected $primaryKey = 'BookingNo';
    public $timestamps = false;
} 