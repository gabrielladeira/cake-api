<?php

use Mockery;
use App\Events\OrderCreated;
use App\Listeners\SendEmailOrderAvailable;
use App\Mail\EmailService;
use App\Mail\OrderAvailable;
use App\Models\Order;
use Tests\TestCase;

class SendEmailOrderAvailableTest extends TestCase 
{
    public function test_send_email_when_order_has_available_cakes()
    {
        Mail::fake();
        $order = $this->mock(Order::class);
        $order->shouldReceive('hasCakes')->andReturn(true);
        $event = new OrderCreated($order);
        
        new SendEmailOrderAvailable()->handle($event);

        Mail::assertSent(OrderAvailable::class);
    }

    public function test_should_not_send_email_when_order_has_no_available_cakes()
    {
        Mail::fake();
        $order = $this->mock(Order::class);
        $order->shouldReceive('hasCakes')->andReturn(false);
        $event = new OrderCreated($order);
        
        new SendEmailOrderAvailable()->handle($event);

        Mail::assertNotSent(OrderAvailable::class);
    }
}