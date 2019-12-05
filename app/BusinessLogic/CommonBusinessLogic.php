<?php 
namespace App\BusinessLogic;

abstract class CommonBusinessLogic {
    
    public $mainObject , $error=NULL, $property= [];
    abstract function action();
    
    function runFunc($actions = []){
        foreach($actions as $action){
            $this->$action();
            if(!is_null($this->error)){
                break;
            }
        }
    }
    
}