<?php
namespace App\BusinessLogic;

use Config;
use Illuminate\Support\Facades\DB;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Ride\Transactions;
use App\Utils\RazorpayUtils;

class CreateTransaction extends CommonBusinessLogic{

    function action(){
        $actions = ['prepareTransactionData', 'createTransactionForRides'];
        $this->runFunc($actions);
    }

    function prepareTransactionData(){
        $paymentModeId = $this->mainObject->request['PaymentModeId'];
        $paymentModeDetails = DB::table(Config::get('tables.payment_mode'))->where('PaymentModeId', $paymentModeId)->first();
        $paymentModeDescr = str_replace(' ', '', $paymentModeDetails->Description);
        $paymentModeDescrNew = $paymentModeDescr == 'Cash'?'CashBooking':$paymentModeDescr; 
        
        $status = Config::get('constants.transaction.pending');
        $data = [];
        $data['RideIds'] = implode(',', array_column($this->mainObject->actionList['Bookings'], 'RideId'));
        $data['Status'] = $status;
        $data['Amount'] = $this->mainObject->request['PayableAmount'];
        $data['PaymentModeId'] = $this->mainObject->request['PaymentModeId'];
        $data['PaymentInfoId'] = $this->mainObject->request['PaymentInfoId']?$this->mainObject->request['PaymentInfoId']:null;
        $data = array_merge($data, $this->getTaxDetails());
        $this->setPaymentModeAndDetails($data);
        $this->property['Transaction'] = $data; 
    }

    function setPaymentModeAndDetails(&$inputArr =[]){
        $paymentModeDescr = Config::get('constants.paymentModes.'.$inputArr['PaymentModeId']);
        $inputArr[str_replace(' ', '', $paymentModeDescr)] = $inputArr['Amount'];
        $gstAndConvenienceCharges = $inputArr['GST'] + $inputArr['ConvenienceCharges']; 
        $inputArr['TollAmount'] = $inputArr['Amount'] - $gstAndConvenienceCharges;
        $inputArr['NetPayableAmount'] = $inputArr['Amount'];
    }

    function getTaxDetails(){
        $taxCalculationArray = json_decode($this->mainObject->request['TaxCalculationDetails'], TRUE);
        $updatedTaxDetailsArr = [];
        foreach($taxCalculationArray as $details){
            $key = str_replace(' ', '', fetch($details, 'Description'));
            $updatedTaxDetailsArr[$key] = fetch($details, 'Amount');
            $updatedTaxDetailsArr[$key.'TaxType'] = fetch($details, 'ValueType');
            $updatedTaxDetailsArr[$key.'TaxValue'] = fetch($details, 'TaxValue');
        }
        return $updatedTaxDetailsArr;
    }

    function createTransactionForRides(){
        $transObj = new Transactions();
        $transObj->props = $this->mainObject->request; 
        $insertData = prepareData($transObj, 
                Config::get('ridestruct.createTransaction'), 
                $this->property['Transaction']);
        $transObj->fill($insertData);
        $transObj->save();
        $this->mainObject->actionList['TransactionId'] = $transObj->TransactionId;        
        $data = [];
        $this->mainObject->actionList['OrderId'] = $transObj->RazorpayOrderId = $this->createOrder();
        $transObj->save();
    }

    private function createOrder(){
        $rzp = new RazorpayUtils();
        $order = $rzp->createOrder($this->mainObject->actionList['TransactionId'], 
                $this->mainObject->request['PayableAmount']);
        return isset($order->id)?$order->id:null;
    }


}
