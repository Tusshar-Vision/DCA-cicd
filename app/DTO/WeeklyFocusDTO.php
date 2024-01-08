<?php

namespace App\DTO;

use App\DTO\Base\PublishedInitiativeDTO;
use App\Models\PublishedInitiative;

class WeeklyFocusDTO extends PublishedInitiativeDTO
{
    public static function fromModel(PublishedInitiative $publishedInitiative): WeeklyFocusDTO|PublishedInitiativeDTO
    {
        return parent::fromModel($publishedInitiative);
    }
}
