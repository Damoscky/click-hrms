<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferenceEmailNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $data = $this->data;
        return (new MailMessage)
                ->greeting('Dear '.$data['contact_name'].'!')
                ->subject("Reference Request - ". auth()->user()->first_name .' '. auth()->user()->last_name)
                ->line(auth()->user()->first_name .' '. auth()->user()->last_name . " has listed you as a reference contact and therefore would appreciate if you could verify some details about " .auth()->user()->first_name .' '. auth()->user()->last_name . " to help us reach our hiring decision.")
                ->line("Please click on the link below to complete the reference form." )
                ->action('Submit Reference', url('/reference/submit/'.$data['token'].'?email='. auth()->user()->email))
                ->line('If the above link does not work, please copy and paste the following URL into your browser');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
