<?php

namespace App\Notifications;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Channels\SendSms;
use App\Models\Common\OTP;

class SendOTP extends Notification
{
    use Queueable;
    public $mainObject;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(&$mainObject)
    {
        $this->mainObject = $mainObject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SendSms::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMessage($notifiable)
    {   
        $otp = rand(1000,9999);
        $obj = new OTP();
        $insertData = [
            'UserId' => $notifiable->UserID,
            'UserType' => 'user',
            'MobileNumber' => $notifiable->MobileNumber,
            'OTPCode' => $otp,
            'GeneratedOn' => date('Y-m-d H:i:s'),
            'ExpiredOn' =>  date('Y-m-d H:i:s', strtotime('+30 min', time()))
        ];
        $obj->fill($insertData);
        $obj->save();
        $this->mainObject->props['OTPId'] = $obj->OTPId;
        return sprintf(Config::get('message.registrationOTP'), $otp);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
