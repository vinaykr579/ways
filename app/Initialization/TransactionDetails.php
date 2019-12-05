<?php
namespace App\Initialization;

use App\Models\Ride\Transactions;
use App\Initialization\CommonInitialization;

class TransactionDetails extends CommonInitialization{

    public function action(){
        $action = ['getTransactionDetails'];
        $this->runFunc($action);
    }

    function getTransactionDetails(){
        $transactionId = $this->mainObject->request['TransactionId'];
        $transaction = Transactions::where('TransactionId', $transactionId)->first();
        $this->mainObject->actionList['Transaction'] = $transaction;
    }
} 