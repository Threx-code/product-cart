<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    const API_V1_PRODUCTS = '/api/v1/products/';

    public function testCreateProductWithoutName()
    {
        $data = [
            'price' => 9.99,
        ];

        $response = $this->post(self::API_V1_PRODUCTS, $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    public function testCreateProductWithoutPrice()
    {
        $data = [
            'name' => 'Sample Product',
        ];

        $response = $this->post(self::API_V1_PRODUCTS, $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('price');
    }

    public function testCreateProductWithValidData()
    {
        $data = [
            'name' => 'Sample Product',
            'price' => 9.99,
        ];

        $response = $this->post(self::API_V1_PRODUCTS, $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $data);
    }

    public function testGetAllProducts()
    {
        $response = $this->get(self::API_V1_PRODUCTS);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'price',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function testGetNonExistentProduct()
    {
        $product = Product::factory()->create();

        $nonExistentProductId = $product->id + 1;

        $response = $this->get(self::API_V1_PRODUCTS . $nonExistentProductId);

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Product not found.'
        ]);
    }

    public function testGetSingleProduct()
    {
        $product = Product::factory()->create();

        $response = $this->get(self::API_V1_PRODUCTS . $product->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
        ]);
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $response = $this->delete(self::API_V1_PRODUCTS . $product->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
