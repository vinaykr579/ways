<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Common\EmailVerifications;


class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $obj = new EmailVerifications();
        $insertData = [
            'EmailId' => $notifiable->EmailId, 
            'UserId' => $notifiable->UserID, 
            'VerificationCode' => $this->token 
        ];
        $obj->fill($insertData);
        $obj->save();
        $url = url('/register/verify-email/'.$this->token);
        return (new MailMessage)
                    ->subject('Verify EmailId ') 
                    ->from('support@waysapp.in', 'Ways')   
                    ->line('Please verify your email to set your password for ways corporate account.')
                    ->action('Verify EmailId', url($url))
                    ->line('Thank you for using our application!');
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
