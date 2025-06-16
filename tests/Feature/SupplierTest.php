<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Supplier;

class SupplierTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_Supplier(){
        Supplier::factory()->count(4)->create();

        $response = $this->getJson('/api/Supplier');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_Supplier(){
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

        $response = $this->postJson('/api/Supplier/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('Supplier', ['name' => 'bola']);
    }

    public function test_show_Supplier(){
        $Supplier = Supplier::factory()->create();
        $response = $this->getJson("/api/Supplier/{$Supplier->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $Supplier->id]);
    }

    public function test_update_Supplier(){
        $Supplier = Supplier::factory()->create();
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

        $response = $this->putJson("/api/Supplier/{$Supplier->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'teste']);

        $this->assertDatabaseHas('Supplier', ['id' => $Supplier->id, 'name' => 'teste']);
    }

    public function test_delete_Supplier(){
        $Supplier = Supplier::factory()->create();

        $response = $this->deleteJson("/api/Supplier/{$Supplier->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('Supplier', ['id' => $Supplier->id]);
    }
}
