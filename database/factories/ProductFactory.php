<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->unique()->words($nb=4,$asText=true);
        $slug = Str::slug($product_name);
        return [
            'name' => $product_name,
            'slug' => $slug,
            'description' => $this->faker->text(200),
            'content' => $this->faker->text(500),
            'price' => $this->faker->numberBetween(10,500),
            'SKU' => 'CUA'.$this->faker->unique()->numberBetween(100,500),
            'stock_status' => 'instock',
            'quantily' => $this->faker->numberBetween(100,200),
            'image' => 'digital_'.$this->faker->unique()->numberBetween(1,22).'.jpg',
            'category_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
