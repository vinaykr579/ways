<?php
namespace App\Http\Controllers\API;

use Validator;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\ContactFormData;

class ContactForm extends Controller{

    public function index(Request $request){
        $isValid = $this->doValidations($request->all());
        if($isValid === true){
            $obj = new ContactFormData();
            $obj->fill($request->all());
            $obj->save();
            echo 'saved';
        }else{
            echo 'Invalid form data.';
        }
    }

    public function doValidations($request){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($request, 
            Config::get('validations.contactFormData'), 
            $customMessages);
        if($validator->fails()){
            return $validator->errors();
        }
        return true;
    }
}