<?php 
namespace App\Models\Ride;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ride\GenerateBookingNo;

class Transactions extends Model{
    protected $table = 'Transactions';
    protected $primaryKey = 'TransactionId';
    public $timestamps = false, $props = [];
    protected $fillable = ['VRNNo', 'InvoiceId','RideIds','Amount','TollAmount','Discounts',
    'UserCredits','Waived','ConvenienceCharges','ConvenienceChargesTaxValue',
    'ConvenienceChargesTaxType','GST','GSTTaxType','GSTTaxValue','EChallan',
    'NetPayableAmount','CashBooking','Card','NetBanking','OTC','Wallet','UPI',
    'PayTM','Status','TxnDate','UserId','InitiatedByUserId','IsRefund',
    'RazorpayOrderId', 'RozorPaymentID','RozorPayResponse','PaymentInfoId',
    'PaymentModeId','AccountingEntry'];

    function getVRNNo(){
        $obj = new GenerateBookingNo();
        $obj->save();
        return $obj->BookingNo;
    }

    function getInvoiceId(){
        $invoiceNo = $this->getUserId().time();
        return 'WAYS-'.date('dmY').'-'.strtoupper(base_convert($invoiceNo,10,36));
    }

    function getUserId(){
        return $this->props['User']->UserID;
    }

    function getInitiatedByUserId(){
        return $this->props['User']->UserID;
    }

}