<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // <- make it public for blade

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Receipt',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.orderReceipt'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
