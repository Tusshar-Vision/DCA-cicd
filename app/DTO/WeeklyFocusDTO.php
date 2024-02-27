<?php

namespace App\DTO;

use App\DTO\Base\PublishedInitiativeDTO;
use App\Models\PublishedInitiative;
use Carbon\Carbon;

class WeeklyFocusDTO extends PublishedInitiativeDTO
{
    public $topicAtGlance;

    public static function fromModel(PublishedInitiative $publishedInitiative): WeeklyFocusDTO|PublishedInitiativeDTO
    {
        $dto = new WeeklyFocusDTO(
            $publishedInitiative->name,
            $publishedInitiative->is_published,
            ArticleDTO::collection($publishedInitiative->articles),
            ArticleDTO::collection($publishedInitiative->shortAarticles),
            Carbon::parse($publishedInitiative->published_at)->format('Y-m-d'),
            $publishedInitiative->created_at,
            $publishedInitiative->updated_at,
            $publishedInitiative->video?->url,
            $publishedInitiative->media->first()
        );
        $dto->topicAtGlance = $publishedInitiative->infographic;

        return $dto;
    }
}
