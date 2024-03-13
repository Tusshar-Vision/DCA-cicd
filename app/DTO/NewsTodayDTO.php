<?php

namespace App\DTO;

use App\DTO\Base\PublishedInitiativeDTO;
use App\Models\PublishedInitiative;

class NewsTodayDTO extends PublishedInitiativeDTO
{
    public static function fromModel(PublishedInitiative $publishedInitiative): NewsTodayDTO|PublishedInitiativeDTO
    {
        $dto = parent::fromModel($publishedInitiative);

        if ($dto->shortArticles->count() !== 0) {
            $firstShortArticle = $dto->shortArticles->first();
            // Update the first short article with custom slug and title
            $firstShortArticle->slug = '/news-today/' . $dto->publishedAt  . '/also-in-news';

            $articlesCollection = collect($dto->articles->all());
            $firstShortArticleCollection = collect([$firstShortArticle]);

            $articlesCollection = $articlesCollection->merge($firstShortArticleCollection);

            $dto->articles = ArticleDTO::collection($articlesCollection);
        }

        return $dto;
    }
}
