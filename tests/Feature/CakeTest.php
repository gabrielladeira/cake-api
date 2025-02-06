<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Cake;

class CakeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create_a_cake_successfully(): void
    {
        $payload = [
            'name' => 'Bolo de chocolate',
            'price' => 90.99,
            'weight' => 1000,
            'quantity' => 20,
        ];

        $response = $this->post('/api/v1/cakes', $payload);

        $response->assertCreated()
            ->assertJson($payload);
    }

    public function test_should_not_create_a_cake_when_payload_is_invalid(): void
    {
        $payload = [
            'name' => 'Bolo de chocolate',
            'price' => 'erro',
            'weight' => 1000,
            'quantity' => 20,
        ];

        $response = $this->post('/api/v1/cakes', $payload);

        $response->assertUnprocessable();
    }

    public function test_list_cakes_successfully(): void
    {
        Cake::factory()->count(20)->create();
        
        $response = $this->get('/api/v1/cakes');

        $response->assertOk();
    }

    public function test_get_a_cake_successfully(): void
    {
        $cake = Cake::factory()->create();

        $response = $this->get('/api/v1/cakes/' . $cake->id);

        $response->assertOk();
    }

    public function test_should_return_not_found_when_cake_doenst_exists(): void
    {
        $invalidId = 10001;

        $response = $this->get('/api/v1/cakes/' . $invalidId);

        $response->assertNotFound();
    }

    public function test_should_update_a_cake_successfully(): void
    {
        $cake = Cake::factory()->create();
        $payload = [
            'name' => 'Bolo de chocolate',
            'price' => 90.99,
            'weight' => 1000,
            'quantity' => 20,
        ];

        $response = $this->put('/api/v1/cakes/' . $cake->id, $payload);

        $response->assertOk()
            ->assertJson($payload);
    }

    public function test_should_not_update_a_cake_when_payload_is_invalid(): void
    {
        $cake = Cake::factory()->create();
        $payload = [
            'name' => 'Bolo de chocolate',
            'price' => 'erro',
            'weight' => 1000,
            'quantity' => 20,
        ];

        $response = $this->put('/api/v1/cakes/' . $cake->id, $payload);

        $response->assertUnprocessable();
    }

    public function test_should_delete_a_cake_successfully(): void
    {
        $cake = Cake::factory()->create();

        $response = $this->delete('/api/v1/cakes/' . $cake->id);

        $response->assertOk();
        $this->assertNull(Cake::find($cake->id) );
    }
}
