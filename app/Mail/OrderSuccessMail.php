<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $orderDetails;
    public function __construct($orderDetails)
    {
        //
        $this->orderDetails = $orderDetails;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Your Order has Placed Successfully')
            ->view('emails.order_sccuess')
            ->with(['orderDetails' => $this->orderDetails]);
    }

}
