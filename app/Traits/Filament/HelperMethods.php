<?php

namespace App\Traits\Filament;

use Carbon\Carbon;

trait HelperMethods
{
    private static function generateName(string $date): array|string
    {
        return str_replace(
            ' ',
            '_',
            static::$modelLabel . ' ' . Carbon::parse($date)
                ->format('Y-m-d')
        );
    }

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
}
