<?php

namespace App\Enums;

enum InitiativeTopics : string
{
    case POLITY = "Polity";
    case INTERNATIONAL_RELATIONS = "International Relations";
    case ECONOMY = "Economy";
    case SECURITY = "Security";
    case ENVIRONMENT = "Environment";
    case SOCIAL = "Social";
    case SCIENCE_AND_TECH = "Science & Tech";
    case CULTURE = "Culture";
    case ETHICS = "Ethics";
    case GOVT_SCHEMES = "Govt Schemes";

    case ALL = "All";
}
