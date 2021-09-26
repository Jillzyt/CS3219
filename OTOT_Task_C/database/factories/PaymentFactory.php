<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'freelancer_ref'              => Str::random(10),
            'payer_name'             => $this->faker->unique()->name(),
            'payer_email'           => $this->faker->unique()->email(),
            'invoice_ref' => Str::random(10),
            'payment_type' => "credit",
            'payment_amount' => "30",
            "payment_status" => "paid",
        ];
    }
}
