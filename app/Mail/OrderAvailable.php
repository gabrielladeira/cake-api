<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class OrderAvailable extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    /**
     * Create a new OrderAvailable message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ótima notícia, o bolo que você deseja está disponível',
            to: $this->order->email,
            
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {  
        $data  = [
            'email' => $this->order->email,
            'cake_name' => $this->order->getCake()->name
        ];

        return new Content(
            view: 'orders.order_available',
            with: ['data' => $data]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
