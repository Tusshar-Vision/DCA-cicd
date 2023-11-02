<?php

namespace Database\Factories;

use App\Models\InitiativeTopic;
use App\Models\PublishedInitiative;
use Filament\Panel;
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
            'content' => fake()->paragraph(100, true),
            'author_id' => 1,
            'published_initiative_id' => PublishedInitiative::all()->random()->id,
            'initiative_topic_id' => InitiativeTopic::all()->random()->id
        ];
    }
}
