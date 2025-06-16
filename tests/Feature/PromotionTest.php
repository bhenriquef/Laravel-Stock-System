<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Promotions;

class PromotionTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_Promotions(){
        Promotions::factory()->count(4)->create();

        $response = $this->getJson('/api/Promotions');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_Promotion(){
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

        $response = $this->postJson('/api/Promotions/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('Promotions', ['name' => 'bola']);
    }

    public function test_show_Promotion(){
        $Promotion = Promotions::factory()->create();
        $response = $this->getJson("/api/Promotions/{$Promotion->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $Promotion->id]);
    }

    public function test_update_Promotion(){
        $Promotion = Promotions::factory()->create();
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

        $response = $this->putJson("/api/Promotions/{$Promotion->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'teste']);

        $this->assertDatabaseHas('Promotions', ['id' => $Promotion->id, 'name' => 'teste']);
    }

    public function test_delete_Promotion(){
        $Promotion = Promotions::factory()->create();

        $response = $this->deleteJson("/api/Promotions/{$Promotion->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('Promotions', ['id' => $Promotion->id]);
    }
}
