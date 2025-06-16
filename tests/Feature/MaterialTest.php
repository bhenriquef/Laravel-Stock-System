<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Material;

class MaterialTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_Materials(){
        Material::factory()->count(4)->create();

        $response = $this->getJson('/api/Materials');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_Material(){
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

        $response = $this->postJson('/api/Materials/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('Materials', ['name' => 'bola']);
    }

    public function test_show_Material(){
        $Material = Material::factory()->create();
        $response = $this->getJson("/api/Materials/{$Material->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $Material->id]);
    }

    public function test_update_Material(){
        $Material = Material::factory()->create();
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

        $response = $this->putJson("/api/Materials/{$Material->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'teste']);

        $this->assertDatabaseHas('Materials', ['id' => $Material->id, 'name' => 'teste']);
    }

    public function test_delete_Material(){
        $Material = Material::factory()->create();

        $response = $this->deleteJson("/api/Materials/{$Material->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('Materials', ['id' => $Material->id]);
    }
}
