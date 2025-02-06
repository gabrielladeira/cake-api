<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\EmailService;
use App\Mail\OrderAvailable;

class SendEmailOrderAvailable
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;

        $cake = $order->getCake();

        if($cake->quantity > 0) {
            $mail = new OrderAvailable($order);
            EmailService::send($mail);
        }
    }
}
