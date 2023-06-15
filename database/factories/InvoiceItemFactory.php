<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->numberBetween(0, 9999);
        $discount = fake()->randomFloat(2, 0, 100);

        return [
            'title' => fake()->text(),
            'price' => $price,
            'discount' => $discount,
            'price_with_discount' => $discount > 0 ? $price * $discount : $price,
            'tax' => 7.7,
            'qty' => rand(1,5),
        ];
    }
}
