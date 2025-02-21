<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    private $orderDetails;

    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails; // Save order details for later use
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database']; // Only database channel
    }



    public function toDatabase($notifiable)
    {
        return [
            'order_ids' => $this->orderDetails['order_ids'], // Array of order IDs
            'user_id' => $this->orderDetails['user_id'], // ID of the user who placed the order
            'user_name' => $this->orderDetails['user_name'], // Name of the user
            'total_amount' => $this->orderDetails['total_amount'], // Total order amount
            'payment_id' => $this->orderDetails['payment_id'], // Razorpay payment ID
            'payment_method' => $this->orderDetails['payment_method'], // Payment method (if applicable)
            'status' => $this->orderDetails['status'], // Payment status (e.g., 'Completed')
            'shipping_address' => $this->orderDetails['shipping_address'], // Address for delivery
            'order_date' => $this->orderDetails['order_date'], // Date and time of order
            'order_items' => $this->orderDetails['order_items'], // List of ordered items
        ];
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
