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

        if($order->hasCakes()) {
            $mail = new OrderAvailable($order);
            EmailService::send($mail);
        }
    }
}
