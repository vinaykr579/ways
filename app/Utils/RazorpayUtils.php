<?php
namespace App\Utils;

use Razorpay\Api\Api;

class RazorpayUtils{

    const KEY = 'rzp_test_6EG87aogPkcGLw';
    const SECRET = 'BYjyJjLzO0WVn2aUJqHzqqO5';
    const WEBHOOK_SECRET = 'Ways@Pp!@#$)(4321+';
    private $api;
    public function __construct() {
        $this->api = new Api(self::KEY, self::SECRET);
    }

    /**
     * 
     * @param string $contactNo
     * @return string
     */

    public function createCustomer($contactNo){
        $customer = $this->api->customer->create(array( 'contact' => $contactNo)); // Creates customer
        return isset($customer->id)?$customer->id:NULL;
    }

    public function createOrder($transactionId, $amount, $payment_capture=0){
        $order = $this->api->order->create(array('receipt' => $transactionId, 'amount' => $amount*100, 'currency' => 'INR', 'payment_capture' => $payment_capture)); // Creates order
        return $order;
    }
    
    /**
     * 
     * @param string $razorpaymentId
     */
    public function getTokenFromRazorpaymentId($razorpaymentId){
        $tokenDetails = $this->api->payment->fetch($razorpaymentId);
        return $tokenDetails->token_id;
    }


    /**
     * 
     * @param string $orderId
     * @param float $amount
     * @param string $customer_id
     * @param string $token_id
     * @param string $phoneCode
     * @param string $contactNo
     * @param string $email
     * @param boolean $recurring
     * @return object Description
     */
    public function createRecurringPayments($orderId, $amount, $customer_id ,$token_id, $phoneCode, $contactNo, $email, $recurring=0){
        $arr = array('order_id'=>$orderId,
            'amount'=> $amount*100,
            'customer_id'=>$customer_id,
            'currency'=>'INR',
            'token'=>$token_id,
            'recurring'=>$recurring,
            'contact'=>'+'.$phoneCode.$contactNo,
            'email'=>$email
          );
        return $this->api->payment->createRecurring($arr);
    }
    
    
    /**
     * 
     * @param string $webhookBody
     */
    public  function verifyRazorpaySignature($webhookBody){
        $razorpaySignature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];
        $this->api->utility->verifyWebhookSignature($webhookBody, $razorpaySignature, self::WEBHOOK_SECRET);
    }
    
    /**
     * 
     * @param string $payload
     * @return string
     */
    public function createSignature($payload){
        return hash_hmac('sha256', $payload, self::WEBHOOK_SECRET);
    }

    public function verifyOrderStatus($orderId, $razorpayid){
        $payment = $this->api->payment->fetch($razorpayid);
        $ret = 'failure'; 
        if($payment->order_id == $orderId && $payment->status == 'authorized' ){
            $ret = 'success';
        }
        return $ret;
    }
    
    
}