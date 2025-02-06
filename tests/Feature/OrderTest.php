<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Cake;
use App\Models\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create_an_order_successfully(): void
    {
        $cake = Cake::factory()->create();
        $payload = [
            'email' => 'email@email.com',
            'cake_id' => $cake->id
        ];

        $response = $this->post('/api/v1/orders', $payload);

        $response->assertCreated()
            ->assertJson($payload);
    }

    public function test_should_not_create_an_order_when_payload_is_invalid(): void
    {
        $cake = Cake::factory()->create();
        $payload = [
            'email' => 'email@',
            'cake_id' => $cake->id
        ];

        $response = $this->post('/api/v1/orders', $payload);

        $response->assertUnprocessable();
    }

    public function test_should_not_create_an_order_when_there_is_no_cake_with_cake_id(): void
    {
        $payload = [
            'email' => 'email@email.com',
            'cake_id' => 10001
        ];

        $response = $this->post('/api/v1/orders', $payload);

        $response->assertUnprocessable();
    }

    public function test_list_orders_successfully(): void
    {
        Order::factory()->count(20)->create();
        
        $response = $this->get('/api/v1/orders');

        $response->assertOk();
    }

    public function test_get_a_cake_successfully(): void
    {
        $cake = Order::factory()->create();

        $response = $this->get('/api/v1/orders/' . $cake->id);

        $response->assertOk();
    }

    public function test_should_return_not_found_when_cake_doenst_exists(): void
    {
        $invalidId = 10001;

        $response = $this->get('/api/v1/orders/' . $invalidId);

        $response->assertNotFound();
    }
}
