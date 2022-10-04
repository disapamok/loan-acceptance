<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIRetrieveLoan extends TestCase
{
    const BEARER_TOKEN = "DIHSGDJIWYX7NSKWUSKAPWFUANDUCWKW";

    public function testLoansLoadedWithoutAuthKey()
    {
        $response = $this->postJson('/api/v1/loan');

        $response
            ->assertStatus(200)
            ->assertJson([
                'error' => true,
                'code' => 'X001'
            ]);
    }

    public function testLoansLoadedWithAuthKey()
    {
        $response = $this->withHeaders([
            'bearer' => self::BEARER_TOKEN
        ])->postJson('/api/v1/loan');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }
}
