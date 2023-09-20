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
                ->subject("Reference Request - ". $data['fullname'])
                ->line($data['fullname'] . " is currently registering with Click Operations (UK) Limited and has provided your name as a referee.  I would be grateful if you could complete the reference form as much detail as possible based on the information available to you to help us reach our hiring decision.")
                ->line("The information you provide may be passed confidentially to prospective employers for the purpose of finding this applicant work. Please indicate clearly on the reference if you do not wish information you provide to be shared in this way.")
                ->line("Please click on the link below to complete the reference form." )
                ->action('Submit Reference', url('/reference/submit/'.$data['token'].'?email='. $data['email']))
                ->line('If you have any queries or need any more information, please do not hesitate to contact me at compliance@clickoperationshealthcare.com');
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
