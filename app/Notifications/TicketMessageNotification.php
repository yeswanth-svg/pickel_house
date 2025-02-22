<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketMessageNotification extends Notification
{
    use Queueable;

    private $messagedetails;

    public function __construct($messagedetails)
    {
        $this->messagedetails = $messagedetails;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->messagedetails['sender_id'],
            'username' => $this->messagedetails['sender_name'],
            'message' => $this->messagedetails['message'],
            'ticket_id' => $this->messagedetails['ticket_id']
        ];
    }
}

