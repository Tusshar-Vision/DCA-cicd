<?php

namespace App\Helpers;

use App\Models\Initiative;
use App\Models\InitiativeTopic;
use Illuminate\Database\Eloquent\Model;

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

    public static function getInitiativeID(string $initiative) : int {
        $initiative = self::formatString($initiative);
        if(!array_key_exists($initiative, self::Initiatives)) {

            $initiative = self::reverseFormatString($initiative);
            $initiativeData = Initiative::where('name', '=', $initiative)->first(['id']);

            /* 0 is returned if we can't find the id for the initiative */
            return is_null($initiativeData) ? false : $initiativeData->id;
        }

        return self::Initiatives[$initiative];
    }

    public static function getInitiativeTopicID(string $initiativeTopic) : int {
        $initiativeTopic = self::formatString($initiativeTopic);
        if(!array_key_exists($initiativeTopic, self::InitiativeTopics)) {

            $initiativeTopic = self::reverseFormatString($initiativeTopic);
            $initiativeTopicData = InitiativeTopic::where('name', '=', $initiativeTopic)->first(['id']);

            return is_null($initiativeTopicData) ? false : $initiativeTopicData->id;
        }

        return self::InitiativeTopics[$initiativeTopic];
    }

    protected static function formatString($string) : string {
        return strtoupper(str_replace('&', 'AND', str_replace(' ', '_', $string))); // To convert name into code.
    }

    protected static function reverseFormatString($formattedString) : string {
        // Revert the conversion done by the original function.
        return strtolower(str_replace('_', ' ', str_replace('AND', '&', $formattedString)));
    }
}
