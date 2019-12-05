<?php
namespace App\Initialization;

abstract class CommonInitialization {
    public $mainObject , $error=NULL; 
    protected $property= [];
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