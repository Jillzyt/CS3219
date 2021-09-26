<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * Tests retrievable of all payment objects
     *
     * @return void
     */
    public function testRetrievePaymentObjects() {

        $response = $this->get('/api/v1/payments');
        $response->assertStatus(200);
    }

    /**
     * Tests creation of payment object
     *
     * @return void
     */
    public function testCreatePaymentObject() {

        $response = $this->postJson('/api/v1/payments',json_decode('{
            "freelancer_ref": "1",
            "payer_name":"John Tan",
            "payer_email": "johntan18@gmail.com",
            "invoice_ref": "4304329",
            "payment_type": "credit",
            "currency": "SGD",
            "payment_amount" : "30",
            "payment_status": "paid"
          }',true));

        $response
        ->assertStatus(201)
        ->assertJson([ "data" => [
            'freelancer_ref' => '1',
            'payer_name' => 'John Tan',
            'payer_email' => 'johntan18@gmail.com',
            'invoice_ref' => '4304329',
            'payment_type' => 'credit',
            'payment_status' => 'paid',
        ]]);
    }

    /**
     * Tests delete payment object
     *
     * @return void
     */
    public function testDeletePaymentObject() {

        $response = $this->postJson('/api/v1/payments',json_decode('{
            "freelancer_ref": "1",
            "payer_name":"John Tan",
            "payer_email": "johntan18@gmail.com",
            "invoice_ref": "4304329",
            "payment_type": "credit",
            "currency": "SGD",
            "payment_amount" : "30",
            "payment_status": "paid"
          }',true));

        
        $response = $this->delete('/api/v1/payments/' . $response->getOriginalContent()['id']);

        $response
        ->assertStatus(204);
    }

    /**
     * Tests delete non existing payment object
     *
     * @return void
     */
    public function testDeleteNonExistingPaymentObject() {

        $response = $this->delete('/api/v1/payments/' . 400);

        $response
        ->assertStatus(404);
    }


    /**
     * Tests update payment object
     *
     * @return void
     */
    public function testUpdatePaymentObject() {
        $response = $this->postJson('/api/v1/payments',json_decode('{
            "freelancer_ref": "1",
            "payer_name":"John Tan",
            "payer_email": "johntan18@gmail.com",
            "invoice_ref": "4304329",
            "payment_type": "credit",
            "currency": "SGD",
            "payment_amount" : "30",
            "payment_status": "paid"
          }',true));

        
        $response = $this->putJson('/api/v1/payments/' . $response->getOriginalContent()['id'] , ["payment_type" => "susan2"]);

        $response
        ->assertStatus(202)
        ->assertJsonPath('data.payment_type', "susan2");
    }

}
