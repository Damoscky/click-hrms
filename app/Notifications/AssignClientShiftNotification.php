<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class AssignClientShiftNotification extends Notification
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
            ->greeting('Hello!')
            ->subject("New Shift Assigned - ". env('APP_NAME'))
            ->line("An employee has been assigned to cover a shift on  " . Carbon::parse($data['date'])->format('j F, Y'))
            ->line("Employee Name: ". $data['employee']['first_name']. ' '.$data['employee']['last_name'] )
            ->line("Employee Phone: ". $data['employee']['phoneno'])
            ->line("Kindly login to your dashboard to view more details" );  
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
