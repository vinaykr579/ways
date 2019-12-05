<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActionClasses\Dashboard\Dashboard;

class DashboardController extends Controller
{
    function index(Request $request){
        $repoObj = new Dashboard($request->all());
        $repoObj->action();
        return response()->json($repoObj->getResponse());
    }

}
