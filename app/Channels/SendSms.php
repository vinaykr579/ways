<?php 
namespace App\Channels;

use Illuminate\Notifications\Notification;

class SendSms{

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification){
        $message = $notification->toMessage($notifiable);
        $to = $notifiable->routeNotificationForSMS();
        $to = '8586936303';
        $url = env('SMS_API_URL').'?loginID='.env('SMS_API_USERNAME').
        '&password='.env('SMS_API_PASSWORD').'&senderid='.env('SMS_API_SEND_FROM').
        '&mobile='.$to.'&text='.urlencode($message);
        curlGetRequest($url);
        
    }
}