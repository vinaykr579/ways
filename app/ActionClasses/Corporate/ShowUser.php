<?php 
namespace App\ActionClasses\Corporate;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;
use Config;

class ShowUser extends  Repo {

    public function action(){
        $actionClasses = Config::get('actionlist.showCorporateuser.action');
        $this->runActions($actionClasses);
    }

    public function getUserRoles(){
        return [
            '1' => 'Super Admin',
            '2' => 'Admin',
            '3' => 'Corporate User'
        ];
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
                    'corporate_users' => $this->actionList['corporate_users'],
                    'user_roles' => $this->getUserRoles()
                ]
            ];
        }
    }

}
    