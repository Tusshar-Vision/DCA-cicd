<?php

namespace Database\Factories;

use App\Models\InitiativeTopic;
use App\Models\PublishedInitiative;
use App\Models\TopicSection;
use App\Models\TopicSubSection;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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

        $initiativeTopicId = InitiativeTopic::all()->random()->id;
        $topicSectionId = null;
        $topicSubSectionId = null;

        $topicSectionIdArray = TopicSection::where('topic_id', '=', $initiativeTopicId)->pluck('id')->toArray();

        if(count($topicSectionIdArray)) {
            $topicSectionId = Arr::random($topicSectionIdArray);
            $topicSubSectionIdArray = TopicSubSection::where('section_id', '=', $topicSectionId)->pluck('id')->toArray();

            if(count($topicSubSectionIdArray)) {
                $topicSubSectionId = Arr::random($topicSubSectionIdArray);
            }
        }

        return [
            'title' => fake()->sentence,
            'content' => fake()->paragraph(100, true),
            'author_id' => 1,
            'published_initiative_id' => 11,
            'initiative_topic_id' => $initiativeTopicId,
            'topic_section_id' => $topicSectionId,
            'topic_sub_section_id' => $topicSubSectionId
        ];
    }
}
