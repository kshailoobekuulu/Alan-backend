<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EndpointsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDocumentationEndPoint()
    {
        $response = $this->get('/api/documentation');
        $response->assertStatus(200);
    }

    public function testProductsList() {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function testActionsList() {
        $response = $this->get('/api/actions');
        $response->assertStatus(200);
    }

    public function testCategoriesList() {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function testCategoryBySlug() {
        $response = $this->get('/api/categories/invalidslug');
        $response->assertStatus(404);
    }

    public function testOrdersList() {
        $response = $this->get('/api/orders');
        $response->assertStatus(200);
    }

    public function testCart() {
        $response = $this->get('/api/get-cart');
        $response->assertStatus(200);
    }
}
