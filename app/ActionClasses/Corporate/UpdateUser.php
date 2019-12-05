<?php 
namespace App\ActionClasses\Corporate;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;
use Config;


class UpdateUser extends  Repo {

    public function action(){
        $actionClasses = Config::get('actionlist.updateCorporateUser.action');
        $this->runActions($actionClasses);
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
                'response' => [
                    'message' => 'Corporate user has been updated.'
                ]
            ];
        }
    }

}
    