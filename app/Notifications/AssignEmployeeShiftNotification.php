<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class AssignEmployeeShiftNotification extends Notification
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
            ->greeting('Hello '. $data['employee']['first_name'].'!')
            ->subject("New Shift Assigned - ". env('APP_NAME'))
            ->line("You've been assigned a new shift for " . Carbon::parse($data['date'])->format('j F, Y'))
            ->line("Client: ". $data['shift']['clients']['clientRecord']['company_name'])
            ->line("Address: ". $data['shift']['clients']['clientRecord']['address'])
            ->action("View Direction", url('https://www.google.com/maps?q=' . urlencode($data['shift']['clients']['clientRecord']['location'])))
            ->line($data['rules_regulations'])
            ->line("Kindly login to your dashboard to accept your shift!" );  
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
