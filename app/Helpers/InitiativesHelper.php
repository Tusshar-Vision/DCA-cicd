<?php

namespace App\Helpers;

use App\Enums\Initiatives;
use App\Enums\InitiativeTopics;
use App\Models\Initiative;
use App\Models\InitiativeTopic;

class InitiativesHelper {

    /**
     * List of initiatives and initiative topics
     */
    private const Initiatives = [
        "NEWS_TODAY" => 1,
        "MONTHLY_MAGAZINE" => 2,
        "WEEKLY_FOCUS" => 3,
        "MAINS_365" => 4,
        "PT_365" => 5,
        "DOWNLOADS" => 6,
        "MORE" => 7,
        "ECONOMIC_SURVEY" => 9,
        "WEEKLY_ROUND_TABLE" => 10,
        "ANIMATED_SHORTS" => 11,
        "PYQ" => 12,
        "VALUE_ADDED_MATERIAL" => 13,
        "VALUE_ADDED_MATERIAL_OPTIONAL" => 14,
        "QUARTERLY_REVISION_DOCUMENTS" => 15,
        "BUDGET" => 17
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
        "ETHICS" => 9,
        "GOVT_SCHEMES" => 10
    ];

    public static function getInitiativeID(Initiatives $initiative) : int {

        if(!array_key_exists($initiative->name, self::Initiatives)) {
            $initiativeData = Initiative::where('name', '=', $initiative->value)->first(['id']);
            /* 0 is returned if we can't find the id for the initiative */
            return is_null($initiativeData) ? false : $initiativeData->id;
        }

        return self::Initiatives[$initiative->name];
    }

    public static function getInitiativeTopicID(InitiativeTopics $initiativeTopic) : int {

        if(!array_key_exists($initiativeTopic->name, self::InitiativeTopics)) {

            $initiativeTopicData = InitiativeTopic::where('name', '=', $initiativeTopic->value)->first(['id']);

            return is_null($initiativeTopicData) ? false : $initiativeTopicData->id;
        }

        return self::InitiativeTopics[$initiativeTopic->name];
    }
}
