<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cover' => $this->faker->imageUrl(640, 300),
            'cover_mini' => $this->faker->imageUrl(300, 300),
            'title' => $this->faker->text(100),
            'text' => $this->faker->sentence(500),
            'slug' => $this->faker->slug(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
