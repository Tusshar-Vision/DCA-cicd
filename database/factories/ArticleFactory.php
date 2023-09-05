<?php

namespace Database\Factories;

use App\Models\PublishedInitiative;
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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'content' => fake()->paragraph(3, true),
            'url_slug' => fake()->url(),
            'author_id' => 1,
            'initiative_id' => rand(1, 6),  
            'published_initiative_id' => PublishedInitiative::all()->random()->id
        ];
    }
}
