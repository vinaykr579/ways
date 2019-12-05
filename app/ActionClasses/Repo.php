<?php 
namespace App\ActionClasses;

use App\ActionClasses\RepoInterface;

abstract class Repo implements RepoInterface{
    public $error, $props = [];
    public $request, $actionList=[];
    
    function __construct($request){
        $this->request = $request;
    }
    
    abstract function createResponse();
    
    function runActions($actions){
        
        foreach($actions as $action){
            $obj = new $action();
            $obj->mainObject = $this; 
            $obj->action();
            if(!is_null($obj->error)){
                $this->error = $obj->error;
                break;
            }
        }
    }

    function runFuns($actions){
        foreach($actions as $action){
            $this->$action();
            if(!is_null($this->error)){
                break;
            }
        }
    }

    function getResponse(){
        return $this->createResponse();
    }
}