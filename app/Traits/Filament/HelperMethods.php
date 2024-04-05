<?php

namespace App\Traits\Filament;

use App\Filament\Resources\BudgetResource;
use App\Filament\Resources\EconomicSurveyResource;
use App\Filament\Resources\Mains365Resource;
use App\Filament\Resources\PT365Resource;
use App\Filament\Resources\QuarterlyRevisionResource;
use App\Filament\Resources\ThePlanetVisionResource;
use App\Filament\Resources\ValueAddedOptionalResource;
use App\Filament\Resources\ValueAddedResource;
use App\Filament\Resources\YearEndReviewResource;
use App\Traits\NameGenerator;
use Carbon\Carbon;

trait HelperMethods
{
    use NameGenerator;

    private static function getCollectionName(): string
    {
        // Convert the label to lowercase
        $label = strtolower(static::$modelLabel);

        // Replace spaces and other possible separators with a dash
        $label = preg_replace('/[\s_]+/', '-', $label);

        // Remove any characters that are not alphanumeric or dashes
        $label = preg_replace('/[^a-z0-9\-]/', '', $label);

        // Optionally, you might want to remove leading, trailing, or multiple consecutive dashes
        $label = trim($label, '-');
        return preg_replace('/-+/', '-', $label);
    }

    public static function getActionPermission(): string {
        return match(static::class) {
            Mains365Resource::class => 'publish_mains365',
            PT365Resource::class => 'publish_p::t365',
            EconomicSurveyResource::class => 'publish_economic::survey',
            BudgetResource::class => 'publish_budget',
            ValueAddedResource::class => 'publish_value::added',
            ValueAddedOptionalResource::class => 'publish_value::added::optional',
            QuarterlyRevisionResource::class => 'publish_quarterly::revision',
            YearEndReviewResource::class => 'publish_year::end::review',
            ThePlanetVisionResource::class => 'publish_the::planet::vision',
            default => throw new \Exception("Permission not defined for resource."),
        };
    }
}
