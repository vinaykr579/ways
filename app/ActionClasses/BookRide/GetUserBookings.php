<?php 
namespace App\ActionClasses\BookRide;

use Illuminate\Support\Facades\DB;
use Config;
use App\ActionClasses\Repo;

class GetUserBookings extends Repo  {

    public function action(){
        $actions = Config::get('actionlist.getUserBookings.action');
        $this->runActions($actions);   
    }

    public function createResponse(){
        if(!is_null($this->error)){
            return [
                'status' => 200,
                'message' => 'error',
                'response' => [
                    'error' => $this->error
                ]
            ];
        }else{
            return [
                'status' => 200,
                'message' => 'success',
                'response' => $this->actionList['Bookings']
            ];
        }
    }
}