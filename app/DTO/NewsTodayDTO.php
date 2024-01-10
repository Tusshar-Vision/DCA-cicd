<?php

namespace App\DTO;

use App\DTO\Base\PublishedInitiativeDTO;
use App\Models\PublishedInitiative;

class NewsTodayDTO extends PublishedInitiativeDTO
{
    public static function fromModel(PublishedInitiative $publishedInitiative): NewsTodayDTO|PublishedInitiativeDTO
    {
        return parent::fromModel($publishedInitiative);
    }
}
