<?php

use Tests\TestCase;
use App\Models\Order;
use App\Mail\OrderAvailable;

class OrderAvailableTest extends TestCase 
{
    public function test_should_build_order_available_mail_correctly()
    {
        $order = Order::factory()->make();

        $mail = new OrderAvailable($order);

        $mail->assertSeeInHtml($order->email); 
        $mail->assertSeeInHtml($order->cake->name);
        $mail->to($order->email);
        $mail->assertHasSubject('Ótima notícia, o bolo que você deseja está disponível');
    }
}