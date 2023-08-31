<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateClientNotification extends Notification
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
                ->greeting('Hello '.$data['name'].'!')
                ->subject("Account Created!")
                ->line("You are receiving this email because your onboarding process was initiated on ". env('APP_NAME'))
                ->line('Click on the button below to complete your registration process and setup your account password.')
                ->action('Complete Registration', url('auth/reset-password/'.$data['verification_code'].'?email='. $data['email']))
                ->line('This link is valid for the next 24 hours.')
                ->line('If you did not recognise this request from '. env('APP_NAME') .' kindly disregard this email.');
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
