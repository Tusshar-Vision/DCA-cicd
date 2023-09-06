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

    private const InitiativeTopics = [
        "POLITY" => 1,
        "INTERNATIONAL_RELATIONS" => 2,
        "ECONOMY" => 3,
        "SECURITY" => 4,
        "ENVIRONMENT" => 5,
        "SOCIAL" => 6,
        "SCIENCE_AND_TECH" => 7,
        "CULTURE" => 8,
        "ETHICS" => 9
    ];

    public static function getInitiativeID($initiative) : int {
        if(!array_key_exists($initiative, self::Initiatives)) return 0;

        return self::Initiatives[$initiative];
    }

    public static function getInitiativeTopicID($initiativeTopic) : int {
        if(!array_key_exists($initiativeTopic, self::InitiativeTopics)) return 0;

        return self::InitiativeTopics[$initiativeTopic];
    }
}