<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_it_can_list_products(){
        Product::factory()->count(4)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                ->assertJsonStructure(['data'])
                ->assertJsonCount(4, 'data');
    }

    public function test_crete_product(){
        $data = [
            'name' => 'bola',
            'details' => 'bola de praia',
            'base_price' => 20,
        ];

        $response = $this->postJson('/api/products/new', $data);

        $response->assertStatus(201)
                ->assertJsonStructure(['data'])
                ->assertJsonFragment(['name' => 'bola']);

        $this->assertDatabaseHas('products', ['name' => 'bola']);
    }

    public function test_show_product(){
        $product = Product::factory()->create();
        $response = $this->getJson("/api/products/{$product->id}");
        $response->assertStatus(200)
                    ->assertJsonFragment(['id' => $product->id]);
    }

    public function test_update_product(){
        $product = Product::factory()->create();
        $data = [
            'name' => 'produto atualizado',
            'details' => 'foi atualizado',
            'base_price' => 20,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);
        $response->assertStatus(200)
                    ->assertJsonFragment(['name' => 'produto atualizado']);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'produto atualizado']);
    }

    public function test_delete_product(){
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");
        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
