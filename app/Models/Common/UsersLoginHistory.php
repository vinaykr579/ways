<?php 
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use EndorphinStudio\Detector\Detector;

class UsersLoginHistory extends Model{
    protected $table = 'UsersLoginHistory';
    protected $primaryKey = 'LoginId';
    public $timestamps = false, $props = [];

    protected $fillable = ['UserId', 'SessionId', 'LoginInTime', 'LogoutTime', 
    'IPAddress', 'PlatformInfo', 'Location'];

    
    function getLoginInTime(){
        return date('Y-m-d H:i:s');
    }

    function getLogoutTime(){
        return date('Y-m-d H:i:s');
    }

    function  getIPAddress(){
        return $_SERVER['REMOTE_ADDR'];
    }

    function getPlatformInfo(){
        $detector = new Detector();
        $result = $detector->analyse();
        $result = json_decode(json_encode($result));
        $platformInfo = [];
        $osname = isset($result->os->name)?$result->os->name:'';
        $osversion = isset($result->os->version)?$result->os->version:'';
        $platformInfo['Os'] = $osname.' '.$osversion;
        $platformInfo['Browser'] = isset($result->browser->name)?ucfirst($result->browser->name):'';
        return json_encode($platformInfo);
    }
    
}
