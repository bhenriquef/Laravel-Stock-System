<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_Clients(){
        Client::factory()->count(4)->create();

        $response = $this->getJson('/api/Clients');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_Client(){
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

        $response = $this->postJson('/api/Clients/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('Clients', ['name' => 'bola']);
    }

    public function test_show_Client(){
        $Client = Client::factory()->create();
        $response = $this->getJson("/api/Clients/{$Client->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $Client->id]);
    }

    public function test_update_Client(){
        $Client = Client::factory()->create();
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

        $response = $this->putJson("/api/Clients/{$Client->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'teste']);

        $this->assertDatabaseHas('Clients', ['id' => $Client->id, 'name' => 'teste']);
    }

    public function test_delete_Client(){
        $Client = Client::factory()->create();

        $response = $this->deleteJson("/api/Clients/{$Client->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('Clients', ['id' => $Client->id]);
    }
}
