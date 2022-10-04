<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class APIRetrieveCustomer extends TestCase
{
    public function test_create_customers_as_guest()
    {
        $response = $this->postJson('/api/v1/customer');
        $response->assertStatus(200)->assertJson([
            'error' => true,
            'code' => 'X001'
        ]);
    }

    public function test_customers_with_key()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/customer');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_creating_new_customer_without_data()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/customer/add');

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_creating_new_customer_with_data()
    {
        $faker = Factory::create();

        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/customer/add', [
            'customer_name' => $faker->name()
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'code' => 'X000'
        ]);
    }

    public function test_customers_with_id()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/customer/get/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }
}
