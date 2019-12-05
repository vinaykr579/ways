<?php
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Ride\Transactions;
use App\Models\Ride\TollFareAndTransactions;

class UpdateTransactions extends CommonBusinessLogic{

    function action(){
        $actions = Config::get('actionlist.updateTransactions.function');
        $this->runFunc($actions);
    }

    public function updateTransactionStatus(){
        Transactions::where('TransactionId', $this->mainObject->request['TransactionId'])
        ->update(['Status'=> $this->mainObject->actionList['TransactionStatus']]);
    }

}
