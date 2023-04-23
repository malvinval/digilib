<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(3),
            "slug" => $this->faker->slug(),
            "author_id" => mt_rand(1, 10),
            "category_id" => mt_rand(1, 3),
            "body" => $this->faker->text(),
            "publisher" => $this->faker->catchPhrase(),
            "published_at" => mt_rand(1900, 2022),
            "total_pages" => mt_rand(1, 200),
            "total_units" => mt_rand(0, 15)
        ];
    }
}
