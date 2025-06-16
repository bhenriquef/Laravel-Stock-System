<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shippings;

class ShippingTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_Shippings(){
        Shippings::factory()->count(4)->create();

        $response = $this->getJson('/api/Shippings');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_Shipping(){
        $data = [
            'name' => 'teste',
            'email' => 'teste',
            'phone' => 'teste',
            'city' => 'teste',
            'state' => 'teste',
            'street' => 'teste',
            'neighborhood' => 'teste',
            'number' => 'teste',
            'cep' => 'teste',
            'country' => 'teste',
        ];

        $response = $this->postJson('/api/Shippings/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('Shippings', ['name' => 'bola']);
    }

    public function test_show_Shipping(){
        $Shipping = Shippings::factory()->create();
        $response = $this->getJson("/api/Shippings/{$Shipping->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $Shipping->id]);
    }

    public function test_update_Shipping(){
        $Shipping = Shippings::factory()->create();
        $data = [
            'name' => 'teste',
            'email' => 'teste',
            'phone' => 'teste',
            'city' => 'teste',
            'state' => 'teste',
            'street' => 'teste',
            'neighborhood' => 'teste',
            'number' => 'teste',
            'cep' => 'teste',
            'country' => 'teste',
        ];

        $response = $this->putJson("/api/Shippings/{$Shipping->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'teste']);

        $this->assertDatabaseHas('Shippings', ['id' => $Shipping->id, 'name' => 'teste']);
    }

    public function test_delete_Shipping(){
        $Shipping = Shippings::factory()->create();

        $response = $this->deleteJson("/api/Shippings/{$Shipping->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('Shippings', ['id' => $Shipping->id]);
    }
}
