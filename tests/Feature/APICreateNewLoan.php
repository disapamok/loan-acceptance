<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class APICreateNewLoan extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_new_loan_without_form_data()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/loan/add');

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_create_new_loan_only_with_customer_name()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/loan/add', [
            'customer_name' => 'Test Name'
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_create_new_loan_with_duration()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/loan/add', [
            'customer_name' => 'Test Name',
            'duration' => 10
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_create_new_loan_with_amount()
    {
        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN
        ])->postJson('/api/v1/loan/add', [
            'customer_name' => 'Test Name',
            'duration' => 10,
            'amount' => 200000,
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_create_new_loan_with_image_file()
    {
        Storage::fake('bank-files');
        $formData = [
            'customer_name' => 'Test Name',
            'duration' => 10,
            'amount' => 200000,
            'bankFile' => UploadedFile::fake()->image('some.jpg')
        ];

        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN,
            'Content-Type' => 'multipart/form-data'
        ])->postJson('/api/v1/loan/add', $formData);

        $response->assertStatus(200)->assertJson([
            'success' => false,
            'code' => 'X000'
        ]);
    }

    public function test_create_new_loan_with_pdf_file()
    {
        Storage::fake('bank-files');
        $filePath = storage_path('app/public/bank-files/1IuAB0hnWc.pdf');

        $formData = [
            'customer_name' => Str::random(10),
            'duration' => 10,
            'amount' => 200000,
            'bankFile' => UploadedFile::fake()->create('test.txt', Str::random(100))
        ];

        $response = $this->withHeaders([
            'bearer' => APIRetrieveLoan::BEARER_TOKEN,
            'Content-Type' => 'multipart/form-data'
        ])->postJson('/api/v1/loan/add', $formData);

        $response->assertStatus(200)->assertJson([
            'success' => true
        ]);
    }
}
