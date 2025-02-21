<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $messageContent;
    public $unsubscribeToken;

    public function __construct($messageContent, $unsubscribeToken)
    {
        $this->messageContent = $messageContent;
        $this->unsubscribeToken = $unsubscribeToken;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Latest News & Updates')
            ->view('emails.newsletter')
            ->with(['unsubscribe_token' => $this->unsubscribeToken]);
    }
}
