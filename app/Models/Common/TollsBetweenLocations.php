<?php 
namespace App\Models\Common;
use Illuminate\Database\Eloquent\Model;

class TollsBetweenLocations extends Model{
    protected $table = 'TollsBetweenLocations';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Location1', 'Location2', 'TollIds', 'Polylines'
    ];
}