<?php

namespace App\Traits;

use Carbon\Carbon;

trait NameGenerator
{
    private static function generateName(string $date): array|string
    {
        return static::$modelLabel . ' ' . Carbon::parse($date)
                ->format('(M d, Y)');
    }
}
