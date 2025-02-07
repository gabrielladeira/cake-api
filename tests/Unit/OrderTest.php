<?php

namespace Tests\Unit;

use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_has_cake_should_be_true_when_quatity_is_gt_zero(): void
    {
        $order = Order::factory()->make();
        $order->cake->quantity = 1;

        $this->assertTrue($order->hasCakes());
    }

    public function test_has_cake_should_be_false_when_quatity_is_equals_zero(): void
    {
        $order = Order::factory()->make();
        $order->cake->quantity = 0;

        $this->assertTrue($order->hasCakes() === false);
    }
}
