<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CorporateUserController extends Controller{

    public function add(Request $request){
        $obj = new \App\ActionClasses\Corporate\AddUser($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    public function update(Request $request){
        $obj = new \App\ActionClasses\Corporate\UpdateUser($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    public function show(Request $request){
        $obj = new \App\ActionClasses\Corporate\ShowUser($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    public function updateStatus(Request $request){
        $obj = new \App\ActionClasses\Corporate\UpdateStatus($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }
}