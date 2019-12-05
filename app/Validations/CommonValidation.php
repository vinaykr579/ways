<?php 
namespace App\Validations;

abstract class CommonValidations {

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
