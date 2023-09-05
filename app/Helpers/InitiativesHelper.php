<?php

namespace App\Helpers;

class InitiativesHelper {

    private const Initiatives = [
        "NEWS_TODAY" => 1,
        "MONTHLY_MAGAZINE" => 2,
        "WEEKLY_FOCUS" => 3,
        "MAINS_365" => 4,
        "PT_365" => 5,
        "DOWNLOADS" => 6 
    ];

    public static function getInitiativeID($initiative) : int {
        return self::Initiatives[$initiative];
    }
}